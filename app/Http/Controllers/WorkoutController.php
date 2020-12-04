<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $workouts = $user->workouts->sortBy('date');
        return view('workouts.index',['user'=>$user,'workouts'=>$workouts]);
    }

    public function create()
    {
        return view('workouts.create');
    }

    public function store(Request $request)
    {
        $workout = new Workout($this->validateWorkout());
        $workout->user_id = auth()->user()->id;
        $workout->save();

        return redirect('workoutlogs/'.$workout->id.'/create');
    }

    public function show(Workout $workout)
    {
        return view('workouts.show', ['workout'=>$workout]);
    }

    public function edit(Workout $workout)
    {
        //
    }

    public function update(Request $request, Workout $workout)
    {
        //
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect('/workouts');
    }

    protected function validateWorkout()
    {
        return request()->validate([
            'date'=>['required']
        ]);
    }

}
