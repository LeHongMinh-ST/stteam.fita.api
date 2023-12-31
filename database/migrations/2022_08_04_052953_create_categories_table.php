<?php

use App\Enums\Category\CategoryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->integer('depth')->default(0);
            $table->string('status')->default(CategoryStatus::ENABLE->value);
            $table->timestamps();
        });
        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('post_id')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_post');
    }
};
