<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiAnalyticsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get start time to calculate duration
        $startTime = microtime(true);

        // Process the request
        $response = $next($request);

        // Calculate request duration
        $duration = microtime(true) - $startTime;

        // Extract useful information
        $data = [
            'method' => $request->method(),
            'endpoint' => $request->path(),
            'status_code' => $response->getStatusCode(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'duration' => round($duration * 1000, 2), // in milliseconds
            'user_id' => $request->user() ? $request->user()->id : null,
            'request_size' => strlen($request->getContent()),
            'response_size' => strlen($response->getContent()),
            'query_params' => json_encode($request->query()),
            'timestamp' => now(),
        ];

        // Log the request
        $this->logApiRequest($data);

        return $response;
    }

    /**
     * Log the API request data
     */
    private function logApiRequest(array $data): void
    {
        try {
            // Insert into database
            DB::table('api_analytics')->insert($data);
        } catch (\Exception $e) {
            // Fallback to logging if database insert fails
            Log::channel('api-analytics')->info('API Request', $data);
            Log::error('Failed to save API analytics', ['error' => $e->getMessage()]);
        }
    }
}
