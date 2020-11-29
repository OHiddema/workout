@extends('layouts.app')

@section('content')

<div class="container">
   <a class="btn btn-primary" href="/workouts/create">Create new workout</a>
   @foreach ($workouts as $workout)
      <p><a href="/workouts/{{$workout->id}}">{{$workout->date}}</a></p>
   @endforeach
</div>

@endsection

