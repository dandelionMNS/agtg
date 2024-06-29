<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use App\Models\Duty_type;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function index()
    {
        $duties = Duty::orderBy('duty_type_id', 'asc')->get();
        $date = Carbon::today()->toDateString();
        return view("duties.index", compact('duties', 'date'));
    }
    public function goToDate($date)
    {
        $duties = Duty::orderBy('duty_type_id', 'asc')->get();
        return view("duties.index", ['duties' => $duties, 'date' => $date]);
    }


    public function addPage($date)
    {
        $users = User::where('position', 'employee')->get();
        $duties = Duty::all();
        $duty_types = Duty_Type::all();
        return view("duties.add", compact('duty_types', 'duties', 'users', 'date'));
    }

    public function add(Request $request)
    {
        $duty = new Duty();
        $duty->user_id = $request->input('user_id');
        $duty->duty_type_id = $request->input('duty_type_id');
        $duty->date = $request->input('date');
        $duty->save();

        return redirect()->route('duty.goto', ['date' => $duty->date]);
    }

    public function delete($id)
    {
        $duty = Duty::findOrFail($id);
        $duty->delete();

        return redirect()->back();
    }

    public function clock_in($duty_id)
    {
        $duty = Duty::findOrFail($duty_id);
        $duty->start = Carbon::now()->format('H:i');

        if (Carbon::parse($duty->start)->gt('10:00:00')) {
            $duty->remarks = "Late clock in";
        }

        $duty->save();
        return redirect()->route('duty.goto', ['date' => $duty->date]);
    }


    function clock_out($duty_id)
    {
        $duty = Duty::findOrFail($duty_id);
        $duty->end = Carbon::now()->format('H:i');

        $startTime = Carbon::parse($duty->start);
        $endTime = Carbon::parse($duty->end);

        // $duration = $startTime->diffInHours($endTime);
        $durationInMinutes = $startTime->diffInMinutes($endTime);
        $hours = floor($durationInMinutes / 60);
        $minutes = $durationInMinutes % 60;
        $duration = sprintf('%02d:%02d', $hours, $minutes);

        $remarks = '';

        if ($duration <= 12) {
            $remarks = 'Leave early. Working time: ' . $duration;
        }

        $duty->remarks = $remarks;
        $duty->save();

        return redirect()->route('duty.goto', ['date' => $duty->date]);
    }
}
