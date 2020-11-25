@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
         <h1>Username: {{$user->name}}</h1>
         @foreach ($workouts as $workout)
         <p>workout-id: {{$workout->id}}</p>
         <p>workout-date: {{$workout->date}}</p>
         @endforeach        </div>
    </div>
</div>
@endsection

