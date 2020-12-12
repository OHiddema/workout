<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workoutlog;
use App\Models\Exercise;
use App\Models\Equipment;
use App\Models\Bodypart;
use DB;

class AnalysisController extends Controller
{
    public function test(Request $request) {

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

        $equipments = Equipment::all()->sortBy('name');
        $bodyparts = Bodypart::all()->sortBy('name');
        $oldequipment = request('equipment');
        $oldbodypart = request('bodypart');

        $workouts = auth()->user()->workouts->sortBy('date');
        if (request('exercise')) {
            $exercise_id = request('exercise');
        } else {
            $exercise_id = 0;
        }

        $sets = DB::table('sets')
                ->select(DB::raw('workouts.date as Date'),DB::raw('MAX((weight*(1+reps/30))) as oneRM'))
                ->join('workoutlogs','sets.workoutlog_id','workoutlogs.id')
                ->join('workouts','workoutlogs.workout_id','workouts.id')
                ->where('workouts.user_id','=',auth()->user()->id)
                ->where('workoutlogs.exercise_id','=',$exercise_id)
                ->orderBy('workouts.date')
                ->groupBy('workouts.date')
                ->get();

        $res = null;
        foreach ($sets as $key => $val) {
            $res[$key++] = [strtotime($val->Date)*1000, $val->oneRM];
        }

        return view('analysis.exercise', [
            'workouts'=>$workouts,
            'exercise_id'=>$exercise_id,
            'exercises'=>$exercises,
            'equipments'=>$equipments,
            'oldequipment'=>$oldequipment,
            'bodyparts'=>$bodyparts,
            'oldbodypart'=>$oldbodypart,
            'graphData'=>json_encode($res),
        ]);
    }
}