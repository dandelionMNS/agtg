<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use App\Models\Duty;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("users.index", compact("users"));
    }

    public function addPage()
    {
        return view("users.add");
    }

    public function add(Request $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->email = $request->input('email');
        $user->position = $request->input('position');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        $user->leave_remaining = $request->input('leave_remaining');
        $user->save();

        $users = User::all();

        return redirect()->route('user.index', ['users' => $users]);
    }


    public function userDetail($id)
    {
        $user = User::findOrFail($id);
        return view('users.userDetails', compact("user"));
    }


    public function userUpdate(Request $request, $id)
    {

        if (!User::findOrFail($id)) {
            return view("dashboard");
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->email = $request->input('email');
        $user->position = $request->input('position');
        $user->phone_no = $request->input('phone_no');
        $user->address = $request->input('address');
        $user->age = $request->input('age');
        $user->leave_remaining = $request->input('leave_remaining');
        $user->save();

        $users = User::all();
        return redirect()->route('user.details', ['id' => $user, 'users' => $users]);
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $users = User::all();
        return redirect()->route('user.index');

    }

    public function monthly_record($id, Request $request)
    {
        $date = $request->input('date');

        $duties = Duty::where('user_id', $id)
            ->whereMonth('date', Carbon::parse($date)->month)
            ->whereYear('date', Carbon::parse($date)->year)
            ->get();

        $user = User::findOrFail($id);
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;

        foreach ($duties as $duty) {
            $startTime = Carbon::parse($duty->start);
            $endTime = Carbon::parse($duty->end);
            $durationInMinutes = $startTime->diffInMinutes($endTime);
            $hours = floor($durationInMinutes / 60);
            $minutes = $durationInMinutes % 60;
            $duty->formatted_duration = sprintf('%02d:%02d', $hours, $minutes);
            $duty->total_minutes = $durationInMinutes;
        }

        $totalDurationInMinutes = $duties->sum('total_minutes');
        $totalHours = floor($totalDurationInMinutes / 60);
        $totalMinutes = $totalDurationInMinutes % 60;

        $leaves = Leave::where('user_id', $id)
            ->where('status', 'Approved')
            ->whereMonth('start', Carbon::parse($date)->month)
            ->whereYear('start', Carbon::parse($date)->year)
            ->get();

        $totalLeaveDays = 0;
        foreach ($leaves as $leave) {
            $start = Carbon::parse($leave->start);
            $end = Carbon::parse($leave->end);
            $days = $start->diffInDays($end) + 1;
            $totalLeaveDays += $days;
        }

        $pdf = PDF::loadView('duties.pdf_content', compact('user', 'duties', 'month', 'year', 'leaves', 'totalLeaveDays', 'totalHours', 'totalMinutes'));
        $filename = 'monthly_duties_' . Carbon::parse($date)->format('Y-m') . '.pdf';
        return $pdf->download($filename);
    }

}
