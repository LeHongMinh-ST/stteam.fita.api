<?php

use App\Enums\ScientificResearch\ScientificResearchStatus;
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
        Schema::create('scientific_research', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('attachment_id')->nullable();
            $table->string('status')->default(ScientificResearchStatus::ENABLE->value);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('department_scientific_research', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('scientific_research_id')->nullable();
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
        Schema::dropIfExists('scientific_research');
        Schema::dropIfExists('department_scientific_research');
    }
};
