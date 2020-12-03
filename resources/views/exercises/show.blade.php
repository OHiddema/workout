@extends('layouts.app')

@section('content')
<a class="btn btn-primary" href="/exercises">All exercises</a><br>

<div class="container rounded border border-dark pb-2 mt-2" style="background-color: rgb(180, 234, 255)">
   <h1>{{$exercise->name}}</h1>
   <p>Equipment: {{$exercise->equipment->name}}</p> 
   <p>
      Bodyparts:
      @foreach ($exercise->bodyparts as $bodypart)
         {{$bodypart->name}}
      @endforeach
   </p>

   <a class="btn btn-primary btn-sm" href="/exercises/{{$exercise->id}}/edit">Edit</a>
   <div class="d-inline-block">
      <form action="/exercises/{{$exercise->id}}" method="POST">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit" title="delete">Delete</button>
      </form>
   </div>
</div>

@endsection