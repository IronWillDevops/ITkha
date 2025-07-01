<?php

namespace App;

enum UserStatusStatus: string
{
    case ACTIVE = 'Active';           // Активний користувач, має повний доступ
    case INACTIVE = 'Inactive';       // Неактивний користувач, тимчасово заблокований або без доступу
    case PENDING = 'Pending';         // Очікує підтвердження (наприклад, підтвердження email)
    case SUSPENDED = 'Suspended';     // Заблокований (тимчасово або назавжди)
    case DELETED = 'Deleted';         // Видалений користувач (архівний статус)
    case BANNED = 'Banned';           // Заборонений за порушення правил
}

