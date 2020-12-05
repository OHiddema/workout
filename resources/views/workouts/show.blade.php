@extends('layouts.app')

@section('content')

<script>

$(function(){

   $(".delWorkoutlog").on("submit", function(){
      return confirm("Are you sure you want to delete this exercise?");
   });

   $(".delWorkout").on("submit", function(){
      return confirm("Are you sure you want to delete this workout?");
   });

}); 

</script>

<style>
   table{
      width: 100%;
      border: 2px solid black;
   }

   th,td {
      border: 1px solid grey;
   }

   tr:nth-child(even) {
   background-color: #ddd;
   }
</style>

<div class="container">
   <h1>{{date('D d-m-Y', strtotime($workout->date))}}</h1>

   <div class="d-inline-block">
      <form class="delWorkout" action="/workouts/{{$workout->id}}" method="POST">
         @csrf
         @method('DELETE')
         <button class="btn btn-danger mb-2" type="submit" title="delete">Delete this workout</button>
      </form>
   
   </div>
   
   <a class="btn btn-primary mb-2" href="/workoutlogs/{{$workout->id}}/create">Add exercise</a>
   <a class="btn btn-primary mb-2" href="/workouts">Back to workouts</a>

   <table>
      <tbody>
         @foreach ($workout->workoutlogs as $workoutlog)
            <tr>
               <td class="p-1">
                  <a class="btn btn-sm btn-primary" href="/workoutlogs/{{$workoutlog->id}}/edit">Edit</a>
                  <form class="delWorkoutlog d-inline-block" action="/workoutlogs/{{$workoutlog->id}}" method="POST">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-sm btn-danger" type="submit" title="delete">Delete</button>
                  </form>
                  <span class="d-inline-block ml-2">{{$workoutlog->exercise->name}}</span>
               </td>
               @foreach ($workoutlog->sets as $set)
                  <td style="text-align: center;">{{$set->reps}}x{{$set->weight}}</td>
               @endforeach
            </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection

