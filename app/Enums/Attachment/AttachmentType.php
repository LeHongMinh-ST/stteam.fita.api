<?php

namespace App\Enums\Attachment;

enum AttachmentType: string
{
    case Image = 'image';
    case Video = 'video';
    case File = 'file';
}
