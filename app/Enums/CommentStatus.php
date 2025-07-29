<?php

namespace App\Enums;

enum CommentStatus: string
{
    case PENDING = 'pending';     // Очікує перевірки
    case APPROVED = 'approved';   // Схвалений
    case REJECTED = 'rejected';   // Відхилений
    case HIDDEN = 'hidden';       // Прихований вручну
}
