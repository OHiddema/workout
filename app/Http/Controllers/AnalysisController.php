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
        return view('analysis.exercise', [
            'workouts'=>$workouts,
            'exercise_id'=>$exercise_id,
            'exercises'=>$exercises,
            'equipments'=>$equipments,
            'oldequipment'=>$oldequipment,
            'bodyparts'=>$bodyparts,
            'oldbodypart'=>$oldbodypart,
        ]);
    }
}