<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises.index',['exercises'=>$exercises]);
    }

    public function create()
    {
        return view('exercises.create',['equipments' => \App\Models\Equipment::all(), 'bodyparts' => \App\Models\Bodypart::all()]);
    }

    public function store(Request $request)
    {
        $exercise = new Exercise($this->validateExercise());
        $exercise->save();

        $exercise->bodyparts()->attach(request('bodyparts'));

        return redirect('/exercises');
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', ['exercise'=>$exercise]);
    }

    public function edit(Exercise $exercise)
    {
        return view('exercises.edit', ['exercise'=>$exercise, 'equipments' => \App\Models\Equipment::all(), 'bodyparts' => \App\Models\Bodypart::all()]);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $exercise->update($this->validateExercise());
        $exercise->bodyparts()->detach();
        $exercise->bodyparts()->attach(request('bodyparts'));
        return redirect('/exercises/'.$exercise->id);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect('/exercises');
    }

    protected function validateExercise()
    {
        return request()->validate([
            'name'=>['required','min:3'],
            'equipment_id'=>['required'],
        ]);
    }
}
