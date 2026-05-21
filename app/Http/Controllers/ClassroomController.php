<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Homework;
use App\Models\Join;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classroom::whereIn(
            'id',
            Join::where('user_id', auth()->id())->pluck('class_id')
        )->get();
        return view('classroom.index', compact("classes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('classroom.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "user_id" => ["required", "exists:users,id"],
            "name" => ["required", "max:100"],
            "description" => ["required"]
        ]);

        do {
            $code = Str::upper(Str::random(8));
        } while (Classroom::where('code', $code)->exists());

        $classroom = Classroom::create([
            "user_id" => $validated["user_id"],
            "name" => $validated["name"],
            "code" => $code,
            "description" => $validated["description"],
          ]);
        
          Join::firstOrCreate([
            "user_id" => $validated["user_id"],
            "class_id" => $classroom->id,
          ]);
            return redirect("/classes");
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {

        $classroom->load('homeworks');

        return view('classroom.show', compact("classroom"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
