<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        $columns = [
            ['key' => 'id', 'label' => 'ID'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'subject', 'label' => 'Subject'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'created_at', 'label' => 'Created At'],
        ];

        $validSortFields = ['id', 'name', 'subject', 'email', 'created_at'];

        $validated = $request->validate([
            'sort_field' => ['nullable', Rule::in($validSortFields)],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sortField = $validated['sort_field'] ?? 'id';
        $sortDirection = $validated['sort_direction'] ?? 'desc';
        $search = $validated['search'] ?? null;

        $query = Contact::query();

        // Поиск
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Сортировка
        $query->orderBy($sortField, $sortDirection);

        $contacts = $query->paginate(10);

        return view('admin.contact.index', [
            'items' => $contacts,          // главный набор данных
            'columns' => $columns,         // колонки
            'sortField' => $sortField,     // поле сортировки
            'sortDirection' => $sortDirection,
            'searchEnabled' => true,       // включаем поиск
            'modelRoute' => 'contact',     // для route('admin.contact.show')
        ]);
    }
}
