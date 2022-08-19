<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyTimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slots = [
            [
                'label' => '9:00',
                'user_id' => 1
            ],
            [
                'label' => '10:30',
                'user_id' => 1
            ],
            [
                'label' => '12:00',
                'user_id' => 1
            ],
            [
                'label' => '15:30',
                'user_id' => 1
            ],
            [
                'label' => '17:00',
                'user_id' => 1
            ],
            [
                'label' => '18:30',
                'user_id' => 1
            ],
            [
                'label' => '20:00',
                'user_id' => 1
            ],
        ];

        DB::table('daily_time_slots')->insert($slots);
    }
}
