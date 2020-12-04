<?php

namespace App\Http\Controllers;

use App\Models\Workoutlog;
use Illuminate\Http\Request;

class WorkoutlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($workout_id)
    {
        $workout = \App\Models\Workout::find($workout_id);
        $exercises = \App\Models\Exercise::all()->sortBy('name');
        return view('workoutlogs.create',['workout'=>$workout,'exercises'=>$exercises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workoutlog  $workoutlog
     * @return \Illuminate\Http\Response
     */
    public function show(Workoutlog $workoutlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workoutlog  $workoutlog
     * @return \Illuminate\Http\Response
     */

     // public function edit(Workoutlog $workoutlog)
    public function edit($workoutlog_id)
    {
        $workoutlog = \App\Models\Workoutlog::find($workoutlog_id);
        $exercises = \App\Models\Exercise::all()->sortBy('name');
        return view('workoutlogs.edit', ['workoutlog'=>$workoutlog,'exercises'=>$exercises]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workoutlog  $workoutlog
     * @return \Illuminate\Http\Response
     */
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

        // $workoutlog = Workoutlog::create(request()->validate([
        //     'exercise_id'=>['required'],
        //     'workout_id'=>['required']
        // ]));

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
        // return redirect('workoutlogs/'.$workout->id.'/create');
        return redirect('workouts/'.$workout->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workoutlog  $workoutlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workoutlog $workoutlog)
    {
        $workoutlog->delete();
        return redirect('workouts/'.$workoutlog->workout->id);
    }
}
