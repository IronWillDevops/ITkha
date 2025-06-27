<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $filter = $request->query('filter'); // Значення: all, read, unread
        $sort = $request->query('sort', 'id'); // Сортувати за колонкою, за замовчуванням 'id'
        $direction = $request->query('direction', 'desc'); // Напрямок сортування

        $contacts = Contact::when($filter === 'read', fn($q) => $q->where('is_read', true))
            ->when($filter === 'unread', fn($q) => $q->where('is_read', false))
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends($request->query()); // Додає параметри до пагінації

        return view('admin.pages.contact.index', compact('contacts', 'filter', 'sort', 'direction'));
    }
}
