<?php

namespace App;

enum PostStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case ARCHIVED = 'Archived';
}
