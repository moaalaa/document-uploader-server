<?php

namespace App\Enums;

enum VideoStatus: string
{
    case Completed = 'completed';
    case Processing = 'processing';
    case Failed = 'failed';
}
