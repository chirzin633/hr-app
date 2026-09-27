<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        // 1. Hapus FK lama HANYA jika benar-benar ada
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasIndex('users', 'users_employee_id_foreign')) {
                $table->dropForeign('users_employee_id_foreign');
            }
        });

        // 2. Hapus kolom lama kalau ada
        if (Schema::hasColumn('users', 'employee_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('employee_id');
            });
        }

        // 3. Buat FK baru ke tabel employees
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('employee_id')
                ->nullable()
                ->after('id')
                ->constrained('employees')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasIndex('users', 'users_employee_id_foreign')) {
                $table->dropForeign('users_employee_id_foreign');
            }

            if (Schema::hasColumn('users', 'employee_id')) {
                $table->dropColumn('employee_id');
            }
        });
    }
};
