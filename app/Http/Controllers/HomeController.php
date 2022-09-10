<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)
            ->orderBy('date','ASC')
            ->get();

        return view('home', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(CreateAppointmentRequest $request)
    {
        $requestData = $request->only('date', 'hour');
        $requestData['user_id'] = auth()->user()->id;

        Appointment::create($requestData);

        return redirect()->back()->with('success', 'Programarea a fost salvata!');
    }

    public function edit(int $id)
    {
        $appointment = Appointment::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('appointments.edit', compact('appointment'));
    }

    public function update(CreateAppointmentRequest $request, int $id)
    {
        $appointment = Appointment::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $appointment->date = $request->get('date');
        $appointment->hour = $request->get('hour');

        $appointment->save();

        return redirect()->back()->with('success', 'Programarea a fost modificate!');
    }

    public function destroy(int $id)
    {
        $appointment = Appointment::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $appointment->delete();

        return redirect()->back()->with('success', 'Programarea a fost stearsa!');
    }

    public function getHours(Request $request)
    {
        $date = $request->get('date');
        $appointments = Appointment::where('date', $date)->get()->pluck('hour')->toArray();
        $appointmentsHoursFlipped = array_flip($appointments);

        $availableHours = [];
        $lastHourKey = null;

        foreach (Appointment::OFFICE_HOURS as $key => $hour) {
            if ($lastHourKey !== null) {
                if (in_array($key, [$lastHourKey, $lastHourKey + 1, $lastHourKey + 2])) {
                    continue;
                }
            }

            if (isset($appointmentsHoursFlipped[$hour])) {
                $lastHourKey = $key;
                continue;
            } else {
                $availableHours[] = $hour;
            }
        }

        return response()->json($availableHours);
    }
}
