<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homework;
use App\Models\Classroom;

class HomeworkController extends Controller
{
    public function create(Request $request)
    {
        $classroom = Classroom::where('id', $request->class_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();
       return view('homework.create', compact('classroom')); 
    }
    public function store(Request $request)
    {
    $classroom = Classroom::where('id', $request->class_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $validated = $request->validate([
        "class_id" => ["required", "exists:classrooms,id"],
        "title" => ["required", "max:100"],
        "description" => ["required"],
        "file" => ["required", "array"],
        "file.*" => ["file", "mimes:pdf,docx,png,jpg"],
        "due_date" => ["required", "date", "after_or_equal:today"]
    ]);

    $paths = [];
    $names = [];

    foreach ($request->file('file') as $file) {
        $paths[] = $file->store('homework_files', 'public');
        $names[] = $file->getClientOriginalName();
    }
    Homework::create([
        "class_id" => $validated["class_id"],
        "title" => $validated["title"],
        "description" => $validated["description"],
        "file" => $paths,
        "file_names" => $names,
        "due_date" => $validated["due_date"]
    ]);

    return redirect("/classes/" . $validated["class_id"]);
    }

    public function download($id, $index)
    {
        $homework = Homework::findOrFail($id);

        $file = $homework->file[$index] ?? null;
        $name = $homework->file_names[$index] ?? 'file';

    if (!$file || !file_exists(storage_path('app/public/' . $file))) {
        abort(404);
    }

    return response()->download(
        storage_path('app/public/' . $file),
        $name
    );
    }

}

