<?php namespace kysel\events\Updates;

use Seeder;
use Kysel\Events\Models\Event;

class SeedEventsTable extends Seeder
{
    public function run()
    {
        $event =
        [ 
            [
                'id'             => 1,
                'name'           => 'RFP',
                'user_id'        => '1',
                'address'        => 'Bratislava',
                'date_start'     => '28-08-2020',
                'date_end'       => '30-08-2020',
                'description'    => 'jjjjjjjjjj',
                'created_at'     => "2020-08-03 14:20:00",
                'updated_at'     => "2020-08-03 14:20:00"
            ],
            [
                'id'             => 2,
                'name'           => 'Slipknot koncert',
                'user_id'        => '1',
                'address'        => 'Bratislava',
                'date_start'     => '02-09-2020',
                'date_end'       => '03-09-2020',
                'description'    => 'jjjjjjjjjj',
                'created_at'     => "2020-08-03 14:20:00",
                'updated_at'     => "2020-08-03 14:20:00"
            ]
        ];

        Event::insert($event);
    }
}