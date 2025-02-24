<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Random\RandomException;
use Throwable;

class StatusController extends Controller
{
    public function simulateCode(Request $request, string $code): JsonResponse
    {
        return $this->getResponse($request->method(), (int) $code);
    }

    /**
     * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     *
     * @param Request $request
     * @return JsonResponse
     * @throws RandomException
     */
    public function generateRandomCode(Request $request): JsonResponse
    {
        $httpStatuses = [
            ['code' => 100, 'meaning' => 'Continue'],
            ['code' => 101, 'meaning' => 'Switching Protocols'],
            ['code' => 102, 'meaning' => 'Processing'],
            ['code' => 103, 'meaning' => 'Early Hints'],
            ['code' => 200, 'meaning' => 'OK'],
            ['code' => 201, 'meaning' => 'Created'],
            ['code' => 202, 'meaning' => 'Accepted'],
            ['code' => 203, 'meaning' => 'Non-Authoritative Information'],
            ['code' => 204, 'meaning' => 'No Content'],
            ['code' => 205, 'meaning' => 'Reset Content'],
            ['code' => 206, 'meaning' => 'Partial Content'],
            ['code' => 207, 'meaning' => 'Multi-Status'],
            ['code' => 208, 'meaning' => 'Already Reported'],
            ['code' => 226, 'meaning' => 'IM Used'],
            ['code' => 300, 'meaning' => 'Multiple Choices'],
            ['code' => 301, 'meaning' => 'Moved Permanently'],
            ['code' => 302, 'meaning' => 'Found'],
            ['code' => 303, 'meaning' => 'See Other'],
            ['code' => 304, 'meaning' => 'Not Modified'],
            ['code' => 305, 'meaning' => 'Use Proxy'],
            ['code' => 307, 'meaning' => 'Temporary Redirect'],
            ['code' => 308, 'meaning' => 'Permanent Redirect'],
            ['code' => 400, 'meaning' => 'Bad Request'],
            ['code' => 401, 'meaning' => 'Unauthorized'],
            ['code' => 402, 'meaning' => 'Payment Required'],
            ['code' => 403, 'meaning' => 'Forbidden'],
            ['code' => 404, 'meaning' => 'Not Found'],
            ['code' => 405, 'meaning' => 'Method Not Allowed'],
            ['code' => 406, 'meaning' => 'Not Acceptable'],
            ['code' => 407, 'meaning' => 'Proxy Authentication Required'],
            ['code' => 408, 'meaning' => 'Request Timeout'],
            ['code' => 409, 'meaning' => 'Conflict'],
            ['code' => 410, 'meaning' => 'Gone'],
            ['code' => 411, 'meaning' => 'Length Required'],
            ['code' => 412, 'meaning' => 'Precondition Failed'],
            ['code' => 413, 'meaning' => 'Request Entity Too Large'],
            ['code' => 414, 'meaning' => 'Request-URI Too Long'],
            ['code' => 415, 'meaning' => 'Unsupported Media Type'],
            ['code' => 416, 'meaning' => 'Requested Range Not Satisfiable'],
            ['code' => 417, 'meaning' => 'Expectation Failed'],
            ['code' => 418, 'meaning' => 'I\'m a teapot'],
            ['code' => 422, 'meaning' => 'Unprocessable Entity'],
            ['code' => 423, 'meaning' => 'Locked'],
            ['code' => 424, 'meaning' => 'Failed Dependency'],
            ['code' => 425, 'meaning' => 'Unordered Collection'],
            ['code' => 426, 'meaning' => 'Upgrade Required'],
            ['code' => 428, 'meaning' => 'Precondition Required'],
            ['code' => 429, 'meaning' => 'Too Many Requests'],
            ['code' => 431, 'meaning' => 'Request Header Fields Too Large'],
            ['code' => 451, 'meaning' => 'Unavailable For Legal Reasons'],
            ['code' => 500, 'meaning' => 'Internal Server Error'],
            ['code' => 501, 'meaning' => 'Not Implemented'],
            ['code' => 502, 'meaning' => 'Bad Gateway'],
            ['code' => 503, 'meaning' => 'Service Unavailable'],
            ['code' => 504, 'meaning' => 'Gateway Timeout'],
            ['code' => 505, 'meaning' => 'HTTP Version Not Supported'],
            ['code' => 506, 'meaning' => 'Variant Also Negotiates'],
            ['code' => 507, 'meaning' => 'Insufficient Storage'],
            ['code' => 508, 'meaning' => 'Loop Detected'],
            ['code' => 510, 'meaning' => 'Not Extended'],
            ['code' => 511, 'meaning' => 'Network Authentication Required'],
        ];
        $position = random_int(0, sizeof($httpStatuses)-1);
        $httpStatus = $httpStatuses[$position];
        return $this->getResponse($request->method(), $httpStatus['code']);
    }

    private function getResponse(string $method, int $code): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'worked',
            'method' => $method
        ];
        try {
            return response()->json(data: $response, status: $code);
        } catch (Throwable $exception) {
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
            return response()->json(data: $response, status: 500);
        }
    }
}
