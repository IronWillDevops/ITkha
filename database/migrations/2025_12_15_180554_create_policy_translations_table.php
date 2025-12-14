<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('policy_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->constrained()->cascadeOnDelete();
            $table->string('locale', 5);
            $table->string('title');
            $table->longText('content');
      //      $table->unique(['policy_id', 'locale']);    
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_translations');
    }
};
