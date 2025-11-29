<?php

namespace App\Http\Controllers\Admin\Posts\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('images/post', 'public');

            return response()->json([
                'url' => Storage::url($path),
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 422);
    }
}
