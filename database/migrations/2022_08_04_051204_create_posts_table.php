<?php

use App\Enums\Post\PostStatus;
use App\Enums\Post\PostType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('type')->default(PostType::NEWS->value);
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('feature_id')->nullable();
            $table->string('status')->default(PostStatus::PENDING->value);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
