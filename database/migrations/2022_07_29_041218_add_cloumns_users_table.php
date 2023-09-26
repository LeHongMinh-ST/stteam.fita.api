<?php

use App\Enums\User\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->boolean('is_super_admin')->default(false);
            $table->boolean('is_teacher')->default(false);
            $table->string('status')->default(UserStatus::ENABLE->value);

            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('full_name');
            $table->dropColumn('role_id');
            $table->dropColumn('is_super_admin');
            $table->dropColumn('is_teacher');
            $table->dropColumn('phone');
            $table->dropColumn('department_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('status');
        });
    }
};
