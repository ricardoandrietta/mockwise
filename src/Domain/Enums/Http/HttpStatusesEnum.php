<?php

namespace MockWise\Domain\Enums\Http;

enum HttpStatusesEnum: string
{
    case STATUS_100 = 'Continue';
    case STATUS_101 = 'Switching Protocols';
    case STATUS_102 = 'Processing';
    case STATUS_103 = 'Early Hints';
    case STATUS_200 = 'OK';
    case STATUS_201 = 'Created';
    case STATUS_202 = 'Accepted';
    case STATUS_203 = 'Non-Authoritative Information';
    case STATUS_204 = 'No Content';
    case STATUS_205 = 'Reset Content';
    case STATUS_206 = 'Partial Content';
    case STATUS_207 = 'Multi-Status';
    case STATUS_208 = 'Already Reported';
    case STATUS_226 = 'IM Used';
    case STATUS_300 = 'Multiple Choices';
    case STATUS_301 = 'Moved Permanently';
    case STATUS_302 = 'Found';
    case STATUS_303 = 'See Other';
    case STATUS_304 = 'Not Modified';
    case STATUS_305 = 'Use Proxy';
    case STATUS_307 = 'Temporary Redirect';
    case STATUS_308 = 'Permanent Redirect';
    case STATUS_400 = 'Bad Request';
    case STATUS_401 = 'Unauthorized';
    case STATUS_402 = 'Payment Required';
    case STATUS_403 = 'Forbidden';
    case STATUS_404 = 'Not Found';
    case STATUS_405 = 'Method Not Allowed';
    case STATUS_406 = 'Not Acceptable';
    case STATUS_407 = 'Proxy Authentication Required';
    case STATUS_408 = 'Request Timeout';
    case STATUS_409 = 'Conflict';
    case STATUS_410 = 'Gone';
    case STATUS_411 = 'Length Required';
    case STATUS_412 = 'Precondition Failed';
    case STATUS_413 = 'Request Entity Too Large';
    case STATUS_414 = 'Request-URI Too Long';
    case STATUS_415 = 'Unsupported Media Type';
    case STATUS_416 = 'Requested Range Not Satisfiable';
    case STATUS_417 = 'Expectation Failed';
    case STATUS_418 = 'I\'m a teapot';
    case STATUS_422 = 'Unprocessable Entity';
    case STATUS_423 = 'Locked';
    case STATUS_424 = 'Failed Dependency';
    case STATUS_425 = 'Unordered Collection';
    case STATUS_426 = 'Upgrade Required';
    case STATUS_428 = 'Precondition Required';
    case STATUS_429 = 'Too Many Requests';
    case STATUS_431 = 'Request Header Fields Too Large';
    case STATUS_451 = 'Unavailable For Legal Reasons';
    case STATUS_500 = 'Internal Server Error';
    case STATUS_501 = 'Not Implemented';
    case STATUS_502 = 'Bad Gateway';
    case STATUS_503 = 'Service Unavailable';
    case STATUS_504 = 'Gateway Timeout';
    case STATUS_505 = 'HTTP Version Not Supported';
    case STATUS_506 = 'Variant Also Negotiates';
    case STATUS_507 = 'Insufficient Storage';
    case STATUS_508 = 'Loop Detected';
    case STATUS_510 = 'Not Extended';
    case STATUS_511 = 'Network Authentication Required';
}
