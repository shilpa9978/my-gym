<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleClass;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $scheduleClasses = ScheduleClass::where('date_time','>', now())
            ->with('classType', 'instructor')
            ->oldest()
            ->get();
        return view('member.book')->with('scheduleClasses', $scheduleClasses);
    }

    public function store(Request $request)
    {
        Auth::user()->bookings()->attach($request->schedule_class_id);
        return redirect()->route('booking.index');
    }

    public function index()
    {
        $bookings = Auth::user()->bookings()->where('date_time', '>', now())->get();
        return view('member.upcoming')->with('bookings', $bookings);
    }

    public function destroy(int $id)
    {
        Auth::user()->bookings()->detach($id);
    }
}
