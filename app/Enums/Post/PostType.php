<?php

namespace App\Enums\Post;

enum PostType: string
{
    case NEWS = 'news';
    case TEACHER = 'teacher';
    case DEPARTMENT = 'department';
}
