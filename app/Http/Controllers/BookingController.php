<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleClass;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $scheduleClasses = ScheduleClass::upcoming()
            ->with('classType', 'instructor')
            ->notBooked()
            ->oldest('date_time')
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
        $bookings = Auth::user()->bookings()->upcoming()->get();
        return view('member.upcoming')->with('bookings', $bookings);
    }

    public function destroy(int $id)
    {
        Auth::user()->bookings()->detach($id);
        return redirect()->route('booking.index');
    }
}
