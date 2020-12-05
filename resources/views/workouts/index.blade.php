@extends('layouts.app')

@section('content')

<div class="container">
   <a class="btn btn-primary mb-2" href="/workouts/create">Create new workout</a>
   @foreach ($workouts as $workout)
      <p><a href="/workouts/{{$workout->id}}">{{date('D d-m-Y', strtotime($workout->date))}}</a></p>
   @endforeach
</div>

@endsection

