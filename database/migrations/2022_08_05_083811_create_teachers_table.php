<?php

use App\Enums\Teacher\TeacherEducationLevel;
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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('teaching_start')->nullable();
            $table->string('teaching_end')->nullable();
            $table->string('education_level')->default(TeacherEducationLevel::Master->value);
            $table->bigInteger('create_by')->nullable();
            $table->bigInteger('update_by')->nullable();
            $table->timestamps();
        });
        Schema::create('teacher_subject', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('subject_id')->nullable();
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
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('teacher_subject');
    }
};
