<?php

namespace App\Http\Controllers;

use App\Models\ClassType;
use App\Models\no;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
