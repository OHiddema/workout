@extends('layouts.app')

@section('content')

<div class="container">
   <p>workout-id: {{$workout->id}}</p>
   <p>workout-date: {{$workout->date}}</p>
   <a class="btn btn-primary" href="/workoutlogs/{{$workout->id}}/create">Add exercise</a>

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

