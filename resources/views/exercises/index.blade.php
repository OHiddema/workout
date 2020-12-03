@extends('layouts.app')

@section('content')

<div class="container">
   <h1>All Exercises</h1>
   <div class="mb-2">
      <a class="btn btn-primary" href="/exercises/create">Create new exercise</a>
   </div>

   @forelse ($exercises as $exercise)
      <div class="container rounded border border-dark mb-2 pl-2 pr-2" style="background-color: rgb(180, 234, 255)">
         <h3><a href="/exercises/{{$exercise->id}}">{{ $exercise->name}}</a></h3>
         <p>
            bodyparts:
            @foreach ($exercise->bodyparts as $bodypart)
               {{$bodypart->name}}
            @endforeach
         </p>
         <p>Equipment: {{$exercise->equipment->name}}</p>
      </div>
   @empty
      <p>No exercises found!</p>
   @endforelse   
</div>

@endsection