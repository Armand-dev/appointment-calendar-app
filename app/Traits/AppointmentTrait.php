<?php

namespace App\Traits;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;

trait AppointmentTrait
{
    /**
     * Mark appointment as Done.
     *
     * @param integer $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsDone(int $appointment_id): \Illuminate\Http\RedirectResponse
    {
        $appointment = Appointment::query()
                                    ->find($appointment_id)
                                    ->update([
                                        'status' => 1
                                    ]);

        return redirect()->route('appointment.index');
    }
}
