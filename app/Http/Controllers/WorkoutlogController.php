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
        $exercises = \App\Models\Exercise::all();
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
        $validatedData = $request->validate([
            'weight1' => 'required',
            'reps1' => 'required',
        ]);

        $validatedData = $request->validate([
            'weight2' => 'required',
            'reps2' => 'required',
        ]);

        $validatedData = $request->validate([
            'weight3' => 'required',
            'reps3' => 'required',
        ]);

        $workoutlog = Workoutlog::create(request()->validate([
            'exercise_id'=>['required'],
            'workout_id'=>['required']
        ]));

        \App\Models\Set::create([
            'weight' => request('weight1'),
            'reps' => request('reps1'),
            'workoutlog_id' => $workoutlog->id
        ]);

        \App\Models\Set::create([
            'weight' => request('weight2'),
            'reps' => request('reps2'),
            'workoutlog_id' => $workoutlog->id
        ]);

        \App\Models\Set::create([
            'weight' => request('weight3'),
            'reps' => request('reps3'),
            'workoutlog_id' => $workoutlog->id
        ]);

        $workout = $workoutlog->workout;
        return redirect('workoutlogs/'.$workout->id.'/create');
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
    public function edit(Workoutlog $workoutlog)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workoutlog  $workoutlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workoutlog $workoutlog)
    {
        //
    }

    // protected function validateWorkoutlog()
    // {
    //     return request()->validate([
    //         'exercise_id'=>['required'],
    //         'workout_id'=>['required']
    //     ]);
    // }

    // protected function validateSet()
    // {
    //     return request()->validate([
    //         'reps'=>['required'],
    //         'weight'=>['required']
    //     ]);
    // }

}
