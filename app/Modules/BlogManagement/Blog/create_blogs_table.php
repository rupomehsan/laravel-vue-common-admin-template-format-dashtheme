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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_category_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link', 100)->nullable();
            $table->string('link_type')->nullable();
            $table->string('image', 250)->nullable();

            $table->string('meta_tag', 250)->nullable();
            $table->string('meta_title', 250)->nullable();
            $table->string('meta_description', 250)->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
