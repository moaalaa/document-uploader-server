<?php

use App\Enums\VideoStatus;
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
        Schema::create('videos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('video_url')->nullable();
            $table->string('file_size')->nullable();
            $table->string('duration')->nullable();
            $table->string('status')->default(VideoStatus::Processing->value);
            $table->boolean('is_new')->default(true);
            $table->string('format')->nullable();
            $table->timestamp('upload_at')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->string('resolution')->nullable();
            $table->string('description')->nullable();

            $table->foreignUuid('creator_id')->nullable()->references('id')->on('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
