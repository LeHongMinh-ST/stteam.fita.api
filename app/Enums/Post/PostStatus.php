<?php
namespace App\Enums\Post;

enum PostStatus: string
{
    case Published = 'published';

    case Draft = 'draft';

    case Pending = 'pending';
}
