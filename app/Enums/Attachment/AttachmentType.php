<?php

namespace App\Enums\Attachment;

enum AttachmentType: string
{
    case IMAGE= 'image';
    case VIDEO = 'video';
    case FILE = 'file';
}
