<?php

namespace App\Http\Controllers;

use App\Services\MediaService;
use Illuminate\Http\Request;

class WysiwygDeleteController extends Controller
{
  public function __construct(
        protected MediaService $mediaService
        
    ) {}
    public function __invoke(Request $request)
    {
       
        $request->validate([
            'media_id' => 'required|integer|exists:media,id',
        ]);

        try {
            $media = \App\Models\Media::findOrFail($request->input('media_id'));
            $this->mediaService->delete($media);

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
