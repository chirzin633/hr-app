<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function ($table) {
            $table->dropForeign(['role_id']);
        });

        Schema::rename('roles', 'job_roles');

        Schema::table('employees', function ($table) {
            $table->foreign('role_id')->references('id')->on('job_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function ($table) {
            $table->dropForeign(['role_id']);
        });
        Schema::rename('job_roles', 'roles');
        Schema::table('employees', function ($table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }
};
