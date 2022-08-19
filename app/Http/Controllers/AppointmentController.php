<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Traits\AppointmentTrait;
use App\Traits\UsesTimeSlots;
use Carbon\Carbon;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    use UsesTimeSlots, AppointmentTrait;

    /**
     * Auth middleware except create and store, so customers can create appointments and keep the laravel docs routing.
     */
    public function __construct()
    {
        $this->middleware('auth')
                ->only([
                    'index',
                    'show',
                    'delete',
                ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $upcomingAppointments = Appointment::query()
                                            ->join('customers', 'customers.id', '=', 'appointments.customer_id')
                                            ->join('daily_time_slots', 'daily_time_slots.id', '=', 'appointments.daily_time_slot_id')
                                            ->where('appointments.status', 0)
                                            ->where('appointments.user_id', auth()->user()->id)
                                            ->select(
                                                'appointments.*',
                                                'customers.name AS customer_name',
                                                'customers.email AS customer_email',
                                                'daily_time_slots.label AS time_start',
                                            )
                                            ->groupBy('appointments.id')
                                            ->orderBy('appointments.day', 'ASC')
                                            ->orderBy('appointments.daily_time_slot_id', 'ASC')
                                            ->get();

        $pastAppointments = Appointment::query()
                                    ->join('customers', 'customers.id', '=', 'appointments.customer_id')
                                    ->join('daily_time_slots', 'daily_time_slots.id', '=', 'appointments.daily_time_slot_id')
                                    ->where('appointments.status', 1)
                                    ->where('appointments.user_id', auth()->user()->id)
                                    ->select(
                                        'appointments.*',
                                        'customers.name AS customer_name',
                                        'customers.email AS customer_email',
                                        'daily_time_slots.label AS time_start',
                                    )
                                    ->groupBy('appointments.id')
                                    ->get();

        return view('appointment.index')
            ->with('upcomingAppointments', $upcomingAppointments)
            ->with('pastAppointments', $pastAppointments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        $request->validate([
            'day' => 'required',
            'time_slot' => 'required',
            'info' => '',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'user_id' => 'required',
        ]);

        $customer = Customer::create([
            'name' => $request->customer_name,
            'email' => $request->customer_email,
        ]);

        $exists = Appointment::query()
                            ->where('day', $request->day)
                            ->where('daily_time_slot_id', $request->time_slot)
                            ->exists();

        if ($exists)
        {
            return response('Not available.', 403);
        }

        Appointment::create([
            'day' => Carbon::parse($request->day),
            'customer_id' => $customer->id,
            'daily_time_slot_id' => $request->time_slot,
            'user_id' => $request->user_id,
            'status' => 0,
            'info' => $request->info
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $appointment
     * @return RedirectResponse
     */
    public function destroy(int $appointment_id): RedirectResponse
    {

        $appointment = Appointment::query()
                                    ->find($appointment_id)
                                    ->delete();

        return redirect()->route('appointment.index');
    }
}
