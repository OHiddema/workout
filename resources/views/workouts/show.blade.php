@extends('layouts.app')

@section('content')

<div class="container">
   <p>workout-id: {{$workout->id}}</p>
   <p>workout-date: {{$workout->date}}</p>

   <form action="/workouts/{{$workout->id}}" method="POST">
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
            <td><a class="btn btn-primary" href="/workoutlogs/{{$workoutlog->id}}/edit">Edit</a></td>
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

