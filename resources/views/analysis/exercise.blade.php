@extends('layouts.app')

@section('content')

<style>
   table{
      width: 100%;
      border: 2px solid black;
   }

   td {
      border: 1px solid grey;
      text-align: center;
   }

   tr:nth-child(even) {
   background-color: #ddd;
   }
</style>

<div class="container">

   <form id="filterform" class="p-2 mb-2 rounded border border-dark" action="/analysis/exercise" method="get" style="background-color: rgb(180, 234, 255)">

      <div class="row align-items-center">
         <div class="col">
            <div class="form-group">
               <label for="equipment">Choose equipment:</label>
               <select
                  name="equipment"
                  id="equipment"
                  class="form-control"
                  onchange="event.preventDefault();document.getElementById('filterform').submit();">
                  <option value="0">All</option>
                  @foreach ($equipments as $equipment)
                     <option value="{{$equipment->id}}"
                     @if ($equipment->id == $oldequipment)
                        selected
                     @endif"
                     >{{$equipment->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col">
            <div class="form-group">
               <label for="bodypart">Choose bodypart:</label>
               <select
                  name="bodypart"
                  id="bodypart"
                  class="form-control"
                  onchange="event.preventDefault();document.getElementById('filterform').submit();">
                  <option value="0">All</option>
                  @foreach ($bodyparts as $bodypart)
                     <option value="{{$bodypart->id}}"
                     @if ($bodypart->id == $oldbodypart)
                        selected
                     @endif"
                     >{{$bodypart->name}}</option>
                  @endforeach
               </select> 
            </div>                  
         </div>
      </div>

      <div class="row align-items-center">
         <div class="col">
            <div class="form-group">
               <label for="exercise">Choose exercise:</label>
               <select
                  name="exercise"
                  id="exercise"
                  class="form-control"
                  onchange="event.preventDefault();document.getElementById('filterform').submit();">
                  <option value="">Choose an exercise:</option>
                  @foreach ($exercises as $exercise)
                     <option value="{{$exercise->id}}"
                     @if ($exercise->id == $exercise_id)
                        selected
                     @endif"
                     >{{$exercise->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>

   </form>

   <table>
      <tbody>
         @foreach ($workouts as $workout)
            @foreach ($workout->workoutlogs as $workoutlog)
               @if ($workoutlog->exercise_id == $exercise_id)
                  <tr>
                     <td>
                        {{date('d-m-Y', strtotime($workout->date))}}
                     </td>
                     @foreach ($workoutlog->sets as $set)
                        <td>
                           {{$set->reps}}x{{$set->weight}}
                        </td>
                     @endforeach
                  </tr>
               @endif                  
            @endforeach
         @endforeach
      </tbody>
   </table>

</div>

@endsection

