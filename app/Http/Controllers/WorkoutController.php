<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $now->day = 1;
        if (request('months')) {
            $months = request('months');
            $now->addMonths(request('months'));
        } else {
            $months = 0;
        }
        $dateFrom = $now->toDateString();
        $header = $now->format('F Y');
        $dateTo = $now->addMonth()->toDateString();

        $user = auth()->user();
        $workouts = $user->workouts;
        $workouts = $workouts->where('date','>=',$dateFrom);
        $workouts = $workouts->where('date','<',$dateTo);
        $workouts = $workouts->sortBy('date');

        return view('workouts.index',['user'=>$user,'workouts'=>$workouts,'months'=>$months,'header'=>$header]);
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
