<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function showCalendar()
    {
        // Dummy event data (replace with your database logic)
        $events = [
            [
                'title' => 'John Doe - Waiter',
                'start' => '2024-07-02', 
                'backgroundColor' => 'red',
            ],
            [
                'title' => 'Jane Smith - Cleaner',
                'start' => '2024-07-10', 
                'backgroundColor' => 'yellow',
            ],
            [
                'title' => 'Mike Lee - Drive-Thru',
                'start' => '2024-07-15', 
                'backgroundColor' => 'blue',
            ],
        ];

        $calendarEvents = [];
        foreach ($events as $event) {
            $calendarEvents[] = [
                'title' => $event['title'],
                'start' => $event['start'],
                'backgroundColor' => $event['backgroundColor'],
            ];
        }

        return view('calendar', compact('calendarEvents'));
    }
}
