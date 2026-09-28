<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;

/**
 * Membatasi user tanpa permission manage hanya ke record miliknya sendiri
 * (dicocokkan via users.employee_id = record.employee_id).
 */
trait FiltersOwnRecords
{
    protected function canManage(string $managePermission): bool
    {
        return auth()->user()->can($managePermission);
    }

    protected function ownEmployeeId(): ?int
    {
        return auth()->user()->employee_id;
    }

    /**
     * @template TModel of \Illuminate\Database\Eloquent\Model
     * @param Builder<TModel> $query
     * @return Builder<TModel>
     */
    protected function scopeToOwn(Builder $query, string $managePermission): Builder
    {
        if ($this->canManage($managePermission)) {
            return $query;
        }

        return $query->where('employee_id', $this->ownEmployeeId() ?? -1);
    }

    /**
     * Abort 403 bila bukan manage dan record bukan milik user sendiri.
     */
    protected function authorizeRecordOwnership(object $record, string $managePermission): void
    {
        if ($this->canManage($managePermission)) {
            return;
        }

        $ownId = $this->ownEmployeeId();

        if ($ownId === null || (int) $record->employee_id !== $ownId) {
            abort(403, 'Anda hanya dapat mengakses data milik sendiri.');
        }
    }

    /**
     * Daftar employee untuk dropdown form: semua (manage) atau diri sendiri.
     */
    protected function selectableEmployees(string $managePermission)
    {
        if ($this->canManage($managePermission)) {
            return Employee::all();
        }

        $ownId = $this->ownEmployeeId();

        return $ownId ? Employee::whereKey($ownId)->get() : collect();
    }

    /**
     * Paksa employee_id ke milik sendiri untuk user tanpa manage.
     */
    protected function resolveEmployeeId(int $submittedId, string $managePermission): int
    {
        if ($this->canManage($managePermission)) {
            return $submittedId;
        }

        $ownId = $this->ownEmployeeId();

        if ($ownId === null) {
            abort(403, 'Akun belum terhubung ke data employee. Hubungi HR.');
        }

        return $ownId;
    }
}
