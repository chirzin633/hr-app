<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::all();

        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $this->getPayrollData($request);

        Payroll::create($data);

        return redirect()->route('payroll.index')->with('success', 'Payroll has been created successfully!');
    }

    public function show(Payroll $payroll)
    {
        return view('payroll.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();

        return view('payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $data = $this->getPayrollData($request);

        $payroll->update($data);

        return redirect()->route('payroll.index')->with('success', 'Payroll has been updated successfully!');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('payroll.index')->with('success', 'Payroll has been deled successfully!');
    }


    private function getPayrollData(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'salary' => ['numeric', 'required', 'min:0'],
            'bonuses' => ['numeric', 'nullable', 'min:0'],
            'deductions' => ['numeric', 'nullable', 'min:0'],
            'pay_date' => ['required', 'date']
        ]);

        $salary = (int) $validated['salary'];
        $bonuses = (int) ($validated['bonuses'] ?? 0);
        $deductions = (int) ($validated['deductions'] ?? 0);
        $net_salary = $salary + $bonuses - $deductions;

        return [
            'employee_id' => $validated['employee_id'],
            'salary' => $salary,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'net_salary' => $net_salary,
            'pay_date' => $validated['pay_date']
        ];
    }

    public function print(Payroll $payroll)
    {
        $pdf = Pdf::loadView('payroll.print', compact('payroll'));

        $pdf->setPaper('A5', 'potrait');

        return $pdf->stream('slip-gaji-' . $payroll->employee->fullname . '.pdf');
    }
}
