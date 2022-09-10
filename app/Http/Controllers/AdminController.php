<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('user')
            ->orderBy('date', 'ASC')
            ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function edit(int $id)
    {
        $appointment = Appointment::where('id', $id)
            ->firstOrFail();

        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(CreateAppointmentRequest $request, int $id)
    {
        $appointment = Appointment::where('id', $id)
            ->firstOrFail();

        $appointment->date = $request->get('date');
        $appointment->hour = $request->get('hour');

        $appointment->save();

        return redirect()->back()->with('success', 'Programarea a fost modificate!');
    }
}
