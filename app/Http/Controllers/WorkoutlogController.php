<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Workoutlog;
use App\Models\Exercise;
use App\Models\Equipment;
use App\Models\Bodypart;

use Illuminate\Http\Request;

class WorkoutlogController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request, $workout_id)
    {
        $exercises = Exercise::all();

        if (request('equipment')) {
            $equipment = Equipment::where('id', request('equipment'))->firstOrFail();
            $exercises = $equipment->exercises;
        }

        if (request('bodypart')) {
            $bodypart = Bodypart::where('id', request('bodypart'))->firstOrFail();
            $exercises = $bodypart->exercises->intersect($exercises);
        }

        $exercises = $exercises->sortBy('name');

        $workout = Workout::find($workout_id);
        $equipments = Equipment::all()->sortBy('name');
        $bodyparts = Bodypart::all()->sortBy('name');
        $oldequipment = request('equipment');
        $oldbodypart = request('bodypart');
        return view('workoutlogs.create',[
            'workout'=>$workout,
            'exercises'=>$exercises,
            'equipments'=>$equipments,
            'oldequipment'=>$oldequipment,
            'bodyparts'=>$bodyparts,
            'oldbodypart'=>$oldbodypart,
        ]);
    }

    public function store(Request $request)
    {
        $nsets = request('nsets');

        for ($i = 0; $i <= $nsets-1; $i++) {
            $request->validate([
                'weight.'.$i => 'bail|required|numeric|min:0|max:1000',
                'reps.'.$i => 'bail|required|numeric|min:1|max:100',
            ],
            [
                'weight.'.$i.'.required' =>'Please fill out the weight',
                'weight.'.$i.'.numeric' =>'The weight must be a number',
                'weight.'.$i.'.min' =>'The weight must be zero or positive',
                'weight.'.$i.'.max' =>'The maximum weight is 1000 kg',
                'reps.'.$i.'.required' =>'Please fill out the reps',
            ]);
        }

        $workoutlog = Workoutlog::create(request()->validate([
            'exercise_id'=>['required'],
            'workout_id'=>['required']
        ]));

        for ($i = 0; $i <= $nsets-1; $i++) {
            \App\Models\Set::create([
                'weight' => request('weight.'.$i),
                'reps' => request('reps.'.$i),
                'workoutlog_id' => $workoutlog->id
            ]);
        }

        $workout = $workoutlog->workout;
        // return redirect('workoutlogs/'.$workout->id.'/create');
        return redirect('workouts/'.$workout->id);
    }

    public function show(Workoutlog $workoutlog)
    {
        //
    }

    public function edit($workoutlog_id)
    {
        $workoutlog = \App\Models\Workoutlog::find($workoutlog_id);
        $exercises = \App\Models\Exercise::all()->sortBy('name');
        return view('workoutlogs.edit', ['workoutlog'=>$workoutlog,'exercises'=>$exercises]);
    }

    public function update(Request $request, Workoutlog $workoutlog)
    {
        $nsets = request('nsets');

        for ($i = 0; $i <= $nsets-1; $i++) {
            $request->validate([
                'weight.'.$i => 'bail|required|numeric|min:0|max:1000',
                'reps.'.$i => 'bail|required|numeric|min:1|max:100',
            ],
            [
                'weight.'.$i.'.required' =>'Please fill out the weight',
                'weight.'.$i.'.numeric' =>'The weight must be a number',
                'weight.'.$i.'.min' =>'The weight must be zero or positive',
                'weight.'.$i.'.max' =>'The maximum weight is 1000 kg',
                'reps.'.$i.'.required' =>'Please fill out the reps',
            ]);
        }

        // Delete the 'old' sets
        \App\Models\Set::where('workoutlog_id',$workoutlog->id)->delete();

        // And refill it with the new data
        for ($i = 0; $i <= $nsets-1; $i++) {
            \App\Models\Set::create([
                'weight' => request('weight.'.$i),
                'reps' => request('reps.'.$i),
                'workoutlog_id' => $workoutlog->id
            ]);
        }

        $workoutlog->update(['exercise_id' => request('exercise_id')]);

        $workout = $workoutlog->workout;
        return redirect('workouts/'.$workout->id);
    }

    public function destroy(Workoutlog $workoutlog)
    {
        $workoutlog->delete();
        return redirect('workouts/'.$workoutlog->workout->id);
    }
}
