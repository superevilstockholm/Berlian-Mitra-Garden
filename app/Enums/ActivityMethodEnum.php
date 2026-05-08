<?php

namespace App\Enums;

enum ActivityMethodEnum: string
{
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
}
