<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassType;
use App\Models\ScheduleClass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduleClasses = auth()->user()
                ->scheduleClasses()
                ->upcoming()
                ->oldest('date_time')
                ->get();
        
        return view('instructor.upcoming',['scheduleClasses' => $scheduleClasses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classTypes = ClassType::all();
        return view('instructor.schedule',['classTypes' => $classTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Date_time = $request->input('date')." ".$request->input('time');
        $request->merge([
            'date_time' => $Date_time,
            'instructor_id' => auth()->user()->id
        ]);
        $validated = $request->validate([
            'class_type_id' => 'required',
            'instructor_id' => 'required',
            'date_time' => 'required|unique:schedule_classes,date_time|after:now',
        ]);
        ScheduleClass::create($validated);
        return redirect()->route('schedule.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleClass $schedule)
    {
        if(Auth::user()->cannot('delete', $schedule))
        {
            abort(403);
        }
        $schedule->delete();
        return redirect()->route('schedule.index');
    }
}
