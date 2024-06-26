<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Leave_type;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::all();
        return view("leaves.index", compact("leaves"));
    }

    public function addPage()
    {
        $leave_types = Leave_type::all();
        return view("leaves.add", compact('leave_types'));
    }

    public function add(Request $request)
    {

        $leave = new Leave();
        $leave->user_id = $request->input('user_id');
        $leave->leave_type_id = $request->input('type');
        $leave->start = $request->input('start');
        $leave->end = $request->input('end');
        $leave->status = 'Pending';
        $leave->save();

        $leaves = Leave::all();

        $leave_id = $leave->id;

        $imageExtension = $request->file('documents')->extension();
        $docName = $leave_id . '.' . $imageExtension;
        $request->file('documents')->move(public_path('documents'), $docName);

        $leave->documents = 'documents/' . $docName;
        $leave->save();
        return redirect()->route('leave.index', ['leaves' => $leaves]);
    }

    public function details($id)
    {
        $leave = Leave::findOrFail($id);
        $leave_types = Leave_type::all();
        return view('leaves.details', compact("leave", 'leave_types'));
    }


    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        
        $leave->user_id = $request->input('user_id');
        $leave->leave_type_id = $request->input('type');
        $leave->start = $request->input('start');
        $leave->end = $request->input('end');
        $leave->status = $request->input('status');
    
        if ($request->hasFile('documents')) {
            if (!empty($leave->documents)) {
                $leavePath = public_path($leave->documents);
    
                if (file_exists($leavePath)) {
                    unlink($leavePath);
                }
            }
    
            $file = $request->file('documents');
            $extension = $file->getClientOriginalExtension();
            $docName = $leave->id . '.' . $extension;
            $file->move(public_path('documents'), $docName);
    
            $leave->documents = 'documents/' . $docName;
        }
    
        $leave->save();
    
        return redirect()->route('leave.details', ['id' => $leave->id]);
    }
    

    public function delete($id)
    {
        $leave = Leave::findOrFail($id);

        if (!empty($leave->documents)) {
            $leavePath = public_path($leave->documents);

            if (file_exists($leavePath)) {
                unlink($leavePath);
            }
        }

        $leave->delete();

        $leaves = Leave::all();
        return redirect()->route('leave.index', compact('leaves'));
    }

}
