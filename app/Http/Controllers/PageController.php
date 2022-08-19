<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Serve event types view.
     *
     * @return View
     */
    public function event(): View
    {
        return view('event');
    }

    /**
     * Serve Dashboard view.
     *
     * @return View
     */
    public function dashboard(): View
    {
        $appointments = Appointment::query()
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->count();;

        return view('dashboard')
            ->with('appointments', $appointments);
    }
}
