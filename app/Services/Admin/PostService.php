<?php

namespace App\Services\Admin;

use App\Enums\PostStatus;
use App\Events\PostPublished;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function store($data, $request)
    {
        // try {
        DB::beginTransaction();

        if (isset($data['tag_ids'])) {
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
        }

        if ($request->hasFile('main_image')) {

            $data['main_image'] = $request->file('main_image')->store('images/main', 'public');
        }



        $post = Post::firstOrCreate($data);
        if (isset($tagIds)) {
            $post->tags()->attach($tagIds);
        }
        $post->comments_enabled = $request->boolean('comments_enabled');



        if ($post->status === PostStatus::PUBLISHED->value) {
              
            event(new PostPublished($post));
        }
        DB::commit();
        // } catch (Exception $expt) {
        //     DB::rollback();
        //     abort(500);
        // }
    }

    public function update($data, $request, $post)
    {
        try {
            DB::beginTransaction();

            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            if ($request->hasFile('main_image')) {

                // Удаляем старый файл, если он есть
                if ($post->main_image && Storage::disk('public')->exists($post->main_image)) {
                    Storage::disk('public')->delete($post->main_image);
                }

                $data['main_image'] = $request->file('main_image')->store('images/main', 'public');
            }
            $oldStatus = $post->status;

            $post->update($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            $post->comments_enabled = $request->boolean('comments_enabled');



            $newStatus = $post->status;
            if ($oldStatus !== PostStatus::PUBLISHED->value && $newStatus === PostStatus::PUBLISHED->value) {
          
                event(new PostPublished($post));
            }

            DB::commit();
        } catch (Exception $expt) {
            DB::rollback();
            abort(500);
        }
        return $post;
    }
}
