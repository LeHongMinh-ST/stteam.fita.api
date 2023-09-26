<?php

namespace App\Enums\Post;

enum PostStatus: string
{
    case PUBLISHED = 'published';

    case DRAFT = 'draft';

    case PENDING = 'pending';
}
