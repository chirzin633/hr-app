<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\UserProvisioning;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Bootstrap Super Admin pertama (atau promosi user mana pun) saat
 * belum ada admin yang bisa melakukannya via UI.
 *
 * Contoh: php artisan user:promote admin@perusahaan.com --role="Super Admin"
 */
class PromoteUser extends Command
{
    protected $signature = 'user:promote
        {email : Email user yang akan dipromosikan}
        {--role=Super Admin : Nama Spatie role target}';

    protected $description = 'Tetapkan Spatie role user + selaraskan employee/job_role (bootstrap admin pertama)';

    public function handle(): int
    {
        $email = trim((string) $this->argument('email'));
        $role = trim((string) $this->option('role'));

        if ($role === '') {
            $this->error('Nama role tidak boleh kosong.');
            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User dengan email '{$email}' tidak ditemukan. Daftarkan dulu via /register.");
            return self::FAILURE;
        }

        $summary = DB::transaction(fn () => UserProvisioning::assignRole($user, $role));

        $user->refresh();

        $this->info("User '{$user->name} <{$user->email}>' sekarang ber-role '{$summary['role']}'.");
        $this->line('Employee ID : ' . ($summary['employee_id'] ?? '-'));
        $this->line('Permissions : ' . $summary['permissions'] . ' (via Spatie role)');

        if ($summary['permissions'] === 0) {
            $this->warn("Role Spatie '{$summary['role']}' belum punya permission. Tambahkan di RolePermissionSeeder lalu re-seed.");
        }

        return self::SUCCESS;
    }
}
