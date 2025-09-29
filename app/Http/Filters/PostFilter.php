<?php


namespace App\Http\Filters;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const SEARCH = 'search';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const CATEGORY_TITLE = 'category';

    public const TAGS = 'tags'; // массив id тегов
    public const AUTHOR = 'author';


    public const SORT_BY = 'sort_by';
    public const SORT_DIR = 'sort_dir';



    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::TITLE => [$this, 'title'],
            self::CONTENT => [$this, 'content'],
            self::CATEGORY_TITLE => [$this, 'category'],
            self::TAGS => [$this, 'tags'],
            self::AUTHOR => [$this, 'author'],

            self::SORT_BY => [$this, 'sortBy'],
        ];
    }


    protected function before(Builder $builder)
    {
        $builder->where('status', PostStatus::PUBLISHED);
        if (!$this->getQueryParam(self::SORT_BY)) {
            $builder->orderBy('created_at', 'desc');
        }
    }
    public function search(Builder $builder, $value)
    {

        $builder->where(function ($query) use ($value) {
            $query->where('title', 'like', "%{$value}%")
                ->orWhere('content', 'like', "%{$value}%")
                ->orWhereHas('category', function (Builder $q) use ($value) {
                    $q->where('title', 'like', "%{$value}%");
                })->orWhereHas('tags', function (Builder $q) use ($value) {
                   $q->where('title', 'like', "%{$value}%");
                })
                ->orWhereHas('author', function ($q) use ($value) {
                    $q->where('login', 'like', "%{$value}%");
                });
        });
    }
    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'like', "%{$value}%");
    }

    // public function category(Builder $builder, $value)
    // {
    //     $builder->whereHas('category', function (Builder $q) use ($value) {
    //         $q->where('title', 'like', "%{$value}%");
    //     });
    // }

    // public function tags(Builder $builder, $value)
    // {
    //     // $value — масив назв тегів
    //     $builder->whereHas('tags', function (Builder $q) use ($value) {
    //         $q->whereIn('tags.title', (array)$value);
    //     });
    // }

    public function author(Builder $builder, $value)
    {
        $builder->whereHas('author', function (Builder $q) use ($value) {
            $q->where('login', 'like', "%{$value}%");
        });
    }

    public function sortBy(Builder $builder, $value)
    {
        $direction = strtolower($this->getQueryParam(self::SORT_DIR, 'desc'));

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $allowed = ['id', 'title', 'created_at', 'updated_at'];

        if (in_array($value, $allowed)) {
            $builder->orderBy($value, $direction);
        } else {
            // За замовчуванням — нові пости зверху
            $builder->orderBy('created_at', 'desc');
        }
    }
}
