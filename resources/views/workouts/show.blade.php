@extends('layouts.app')

@section('content')

<script>

$(function(){
   if ({{$workout->rating}} < 1) {$('#star1').addClass('checked');}
   if ({{$workout->rating}} < 2) {$('#star2').addClass('checked');}
   if ({{$workout->rating}} < 3) {$('#star3').addClass('checked');}
   if ({{$workout->rating}} < 4) {$('#star4').addClass('checked');}
   if ({{$workout->rating}} < 5) {$('#star5').addClass('checked');}

   $(".delWorkoutlog").on("submit", function(){
      return confirm("Are you sure you want to delete this exercise?");
   });

   $(".delWorkout").on("submit", function(){
      return confirm("Are you sure you want to delete this workout?");
   });

}); 

</script>

<div class="container">
   <h3>Training: {{date('l j-n-Y', strtotime($workout->date))}}</h3>

   <div>Rating:</div>
   <div>
      <span class="fa fa-star" id="star1"></span>
      <span class="fa fa-star" id="star2"></span>
      <span class="fa fa-star" id="star3"></span>
      <span class="fa fa-star" id="star4"></span>
      <span class="fa fa-star" id="star5"></span>
   </div>

   @if ($workout->remarks != "")
      <div>Remarks:</div>
      <div class="mb-2">
         <span class="rounded p-1" style="background-color: lightgrey">{{$workout->remarks}}</span>
      </div>
   @endif

   <a class="btn btn-primary mb-2" href="/workouts/{{$workout->id}}/edit">Edit workout</a>
   <div class="d-inline-block">
      <form class="delWorkout" action="/workouts/{{$workout->id}}" method="POST">
         @csrf
         @method('DELETE')
         <button class="btn btn-danger mb-2" type="submit" title="delete">Delete workout</button>
      </form>
   </div>   

   <div id="sets" class="border-top border-dark">

      <div class="text-center">
         <a class="btn btn-primary mt-2" href="/workoutlogs/{{$workout->id}}/create">Add exercise</a>
      </div>
         
      <table class="mt-2">
         <thead class="thead-light" style="text-align: center">
            <tr>
               <th>Exercise</th>
               @for ($i = 1; $i <= $maxSets; $i++)
                  <th>Set {{$i}}<br><small>reps x kg</small></th>
               @endfor
            </tr>
         </thead>
         <tbody>
            @foreach ($workout->workoutlogs as $workoutlog)
               <tr>
                  <td class="p-1" style="text-align: left;">
                     <a class="btn btn-sm btn-primary" href="/workoutlogs/{{$workoutlog->id}}/edit">Edit</a>
                     <form class="delWorkoutlog d-inline-block" action="/workoutlogs/{{$workoutlog->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit" title="delete">Delete</button>
                     </form>
                     <span class="d-inline-block ml-2">{{$workoutlog->exercise->name}}</span>
                  </td>
                  @foreach ($workoutlog->sets as $set)
                     <td>{{$set->reps}} x {{$set->weight}}</td>
                  @endforeach
                  @for ($i = $workoutlog->sets->count(); $i < $maxSets; $i++)
                  <td></td>
              @endfor
     </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

@endsection