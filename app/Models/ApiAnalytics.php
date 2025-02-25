<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiAnalytics extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_analytics';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'method',
        'endpoint',
        'status_code',
        'ip',
        'user_agent',
        'duration',
        'user_id',
        'request_size',
        'response_size',
        'query_params',
        'timestamp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration' => 'float',
        'query_params' => 'array',
        'timestamp' => 'datetime',
    ];

    /**
     * Scope a query to only include requests for a specific endpoint.
     */
    public function scopeEndpoint($query, string $endpoint)
    {
        return $query->where('endpoint', 'like', "%{$endpoint}%");
    }

    /**
     * Scope a query to only include requests with a specific method.
     */
    public function scopeMethod($query, string $method)
    {
        return $query->where('method', $method);
    }

    /**
     * Scope a query to only include requests within a date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('timestamp', [$startDate, $endDate]);
    }

    /**
     * Get the user that made this request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
