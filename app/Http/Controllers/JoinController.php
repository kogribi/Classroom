<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Classroom;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('join.index');
    }

     public function join(Request $request)
    {
        $validated = $request->validate([
            "user_id" => ["required", "exists:users,id"],
            "code" => ["required", "exists:classrooms,code"],
        ]);

        $class_id = Classroom::where('code', $validated["code"])->value('id');
        
        Join::firstOrCreate([
            "user_id" => $validated["user_id"],
            "class_id" => $class_id,
          ]);
        


        return redirect('classes');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Join $join)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Join $join)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Join $join)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Join $join)
    {
        //
    }
}
