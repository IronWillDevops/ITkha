<?php

namespace App\Http\Controllers;

use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WysiwygUploadController extends Controller
{
    public function __construct(
        protected MediaService $mediaService
    ) {}

    /**
     * Загрузка файлов (изображений и других) из WYSIWYG редактора
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // макс 20MB
            'model_type' => 'required|string',
            'model_id' => 'nullable|integer',
        ]);

        try {
            $file = $request->file('file');

            // Определяем модель для привязки медиа
            $modelClass = $request->input('model_type');
            $modelId = $request->input('model_id');

            // Если это новый пост (еще не создан), используем User как временное хранилище
            if (!$modelId) {
                $model = Auth::user();
                $collection = 'wysiwyg_temp';
            } else {
                $model = $modelClass::findOrFail($modelId);
                $collection = 'wysiwyg_content';
            }

            // Загружаем файл через MediaService
            $media = $this->mediaService->upload(
                $model,
                $file,
                $collection
            );

            // Определяем тип файла для фронтенда
            $isImage = str_starts_with($media->mime_type, 'image/');

            return response()->json([
                'success' => true,
                'url' => $media->url,
                'media_id' => $media->id,
                'is_image' => $isImage,
                'mime_type' => $media->mime_type,
                'original_name' => $media->original_name,
                'size' => $media->size,
                'human_size' => $media->human_size,
            ]);
        } catch (\Exception $e) {
            \Log::error('WYSIWYG file upload failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
