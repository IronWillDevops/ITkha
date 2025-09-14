<?php

namespace App\Services\Admin;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function store($data, $request)
    {
        try {
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
            DB::commit();
        } catch (Exception $expt) {
            Db::rollback();
            abort(500);
        }
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


            $post->update($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            $post->comments_enabled = $request->boolean('comments_enabled');
            DB::commit();
        } catch (Exception $expt) {
            Db::rollback();
            abort(500);
        }
        return $post;
    }
}
