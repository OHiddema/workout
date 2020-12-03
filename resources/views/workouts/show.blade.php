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

<div class="container">
   <p>workout-id: {{$workout->id}}</p>
   <p>workout-date: {{$workout->date}}</p>

   <form class="delWorkout" action="/workouts/{{$workout->id}}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger mb-2" type="submit" title="delete">Delete this workout</button>
   </form>
   
   <a class="btn btn-primary mb-2" href="/workoutlogs/{{$workout->id}}/create">Add exercise</a>

   <table class="table table-sm">
      {{-- <thead class="thead-light">
         <tr>
            <th>Id</th>
            <th>Date</th>
         </tr>
      </thead> --}}
      <tbody>
         @foreach ($workout->workoutlogs as $workoutlog)
         <tr>
            <td><a class="btn btn-sm btn-primary" href="/workoutlogs/{{$workoutlog->id}}/edit">Edit</a></td>
            <td>
               <form class="delWorkoutlog" action="/workoutlogs/{{$workoutlog->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit" title="delete">Delete</button>
               </form>
            </td>
            <td>{{$workoutlog->exercise->name}}</td>
               @foreach ($workoutlog->sets as $set)
                  <td>{{$set->reps}}x{{$set->weight}}</td>
               @endforeach
            </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection

