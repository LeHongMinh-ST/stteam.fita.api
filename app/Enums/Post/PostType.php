<?php
namespace App\Enums\Post;

enum PostType: string
{
    case News = 'news';
    case Teacher = 'teacher';
    case Department = 'department';
}
