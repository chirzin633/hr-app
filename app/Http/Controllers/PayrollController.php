<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
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
        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'salary' => ['numeric', 'required', 'min:0'],
            'bonuses' => ['numeric', 'nullable', 'min:0'],
            'deductions' => ['numeric', 'nullable', 'min:0'],
            'pay_date' => ['required', 'date']
        ]);

        $bonuses = $validated['bonuses'] ?? 0;
        $deductions = $validated['deductions'] ?? 0;
        $net_salary = $validated['salary'] + $bonuses - $deductions;

        $data = [
            'employee_id' => $validated['employee_id'],
            'salary' => $validated['salary'],
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'net_salary' => $net_salary,
            'pay_date' => $validated['pay_date']
        ];

        Payroll::create($data);

        return redirect()->route('payroll.index')->with('success', 'Payroll has been created successfully!');
    }

    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();

        return view('payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'exists:employees,id'],
            'salary' => ['numeric', 'required', 'min:0'],
            'bonuses' => ['numeric', 'nullable', 'min:0'],
            'deductions' => ['numeric', 'nullable', 'min:0'],
            'pay_date' => ['required', 'date']
        ]);

        $bonuses = $validated['bonuses'] ?? 0;
        $deductions = $validated['deductions'] ?? 0;
        $net_salary = $validated['salary'] + $bonuses - $deductions;

        $data = [
            'employee_id' => $validated['employee_id'],
            'salary' => $validated['salary'],
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'net_salary' => $net_salary,
            'pay_date' => $validated['pay_date']
        ];

        $payroll->update($data);

        return redirect()->route('payroll.index')->with('success', 'Payroll has been updated successfully!');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('payroll.index')->with('success', 'Payroll has been deled successfully!');
    }
}
