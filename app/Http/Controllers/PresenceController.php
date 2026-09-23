<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::all();

        return view('presence.index', compact('presences'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('presence.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required'],
            'check_in' => ['required', 'date_format:H:i'],
            'check_out' => ['required', 'date_format:H:i'],
            'date' => ['required', 'date'],
            'status' => ['required', 'string']
        ]);

        $validated['check_in'] = $validated['check_in'] . ':00';
        if ($validated['check_out']) {
            $validated['check_out'] = $validated['check_out'] . ':00';
        }

        Presence::create($validated);

        return redirect()->route('presence.index')->with('success', 'Presence recorded succesfully!');
    }
}
