<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $presence = Presence::count();
        $tasks = Task::latest()->take(5)->get();

        $presenceChart = $this->getPresenceChart();


        return view('dashboard.index', compact('employee', 'department', 'payroll', 'presence', 'tasks', 'presenceChart'));
    }

    private function getPresenceChart()
    {
        // 6 bulan terakhir
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }
        $labels = $months->map(fn($m) => $m->format('M Y'))->toArray();

        // Ambil semua data presensi tanpa filter user
        $raw = Presence::where('date', '>=', $months->first()->startOfMonth())
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as ym"),
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('ym', 'status')
            ->get();

        $statusList = ['present', 'leave', 'sick', 'absent'];
        $colors = [
            'present' => '#00B894',
            'leave'  => '#FDCB6E',
            'sick' => '#0984E3',
            'absent' => '#D63031',
        ];

        $datasets = [];
        foreach ($statusList as $st) {
            $dataPerMonth = [];
            foreach ($months as $m) {
                $ym = $m->format('Y-m');
                $found = $raw->first(fn($r) => $r->ym === $ym && strtolower($r->status) === $st);
                $dataPerMonth[] = $found ? $found->total : 0;
            }
            $datasets[] = [
                'label' => ucfirst($st),
                'data' => $dataPerMonth,
                'backgroundColor' => $colors[$st],
                'borderRadius' => 4,
            ];
        }
        return compact('labels', 'datasets');
    }
}
