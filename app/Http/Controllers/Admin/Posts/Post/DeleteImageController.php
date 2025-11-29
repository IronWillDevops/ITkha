<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeleteImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $url = $request->input('url');

        // Извлекаем относительный путь из URL
        $parsed = parse_url($url, PHP_URL_PATH);
        $relativePath = Str::after($parsed, '/storage/');

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
            return response()->json(['message' => 'Image deleted successfully.']);
        }

        return response()->json(['message' => 'Image not found.'], 404);
    }
}
