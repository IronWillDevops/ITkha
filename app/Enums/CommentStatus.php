<?php

namespace App\Enums;

enum CommentStatus: string
{
    case PENDING = 'Pending';     // Очікує перевірки
    case APPROVED = 'Approved';   // Схвалений
    case REJECTED = 'Rejected';   // Відхилений
    case HIDDEN = 'Hidden';       // Прихований вручну
}
