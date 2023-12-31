<?php

use App\Enums\Subject\SubjectStatus;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('credit_practice')->nullable();
            $table->string('subject_code')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->boolean('is_required')->default(true);
            $table->string('status')->default(SubjectStatus::ENABLE->value);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('semester_subject', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('semester_id')->nullable();
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
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('semester_subject');
    }
};
