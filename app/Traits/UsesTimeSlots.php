<?php

namespace App\Traits;

use App\Models\Appointment;
use App\Models\DailyTimeSlot;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

trait UsesTimeSlots
{
    /**
     * Get available time slots for a given day.
     *
     * @param string $date
     * @return JsonResponse
     */
    public function getAvailableTimeSlots(string $date): JsonResponse
    {
        $date = Carbon::parse($date);

        if ($date->isWeekend())
        {
            return response()->json([]);
        }

        if ($date->addDay()->isPast())
        {
            return response()->json([]);
        }
        $date->subDay();

        $usedTimeSlotIds = Appointment::query()
                                        ->where('day', $date)
                                        ->pluck('id')
                                        ->toArray();

        $freeTimeSlots = DailyTimeSlot::query()
                                        ->whereNotIn('id', $usedTimeSlotIds)
                                        ->get();

        if ($date->isToday())
        {
            foreach ($freeTimeSlots as $key => $slot)
            {
                $time = explode(':', $slot->label);
                $makeDatetime = Carbon::now()->hours($time[0])->minutes($time[1]);

                if ($makeDatetime < Carbon::now('UTC')->addHours(3)) // Romania Time Zone UTC+3
                {
                    unset($freeTimeSlots[$key]);
                }
            }
            $freeTimeSlots = array_values($freeTimeSlots->toArray());
        }

        return response()->json($freeTimeSlots);
    }
}
