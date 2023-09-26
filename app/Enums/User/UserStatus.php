<?php

namespace App\Enums\User;

enum UserStatus: string
{
    case ENABLE = 'enable';
    case DISABLE = 'disable';
}
