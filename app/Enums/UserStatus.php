<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'Active';           // Активний користувач, має повний доступ
    case PENDING = 'Pending';         // Очікує підтвердження (наприклад, підтвердження email)
    case BANNED = 'Banned';           // Заборонений за порушення правил
}
