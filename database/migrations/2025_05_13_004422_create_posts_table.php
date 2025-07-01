<?php

use App\PostStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_posts_table.php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('main_image')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('title');
            $table->text('content');
            $table->enum('status',array_column(PostStatus::cases(), 'value'))->default(PostStatus::DRAFT->value);
           
            $table->integer('views')->default(0);

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->default(1);
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
