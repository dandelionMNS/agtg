<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function monthly_rec($date)
    {
        $duties = Duty::whereMonth('date', Carbon::parse($date)->month)
            ->whereYear('date', Carbon::parse($date)->year)
            ->get();

        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;

        $pdf = PDF::loadView('duty.pdf_content', compact('duties', 'month', 'year'));
        $filename = 'monthly_duties_' . Carbon::parse($month)->format('Y-m') . '.pdf';
        return $pdf->download($filename);
    }
}
