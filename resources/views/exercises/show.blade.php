@extends('layouts.app')

@section('content')

<script>

   $(function(){
   
      $(".delExercise").on("submit", function(){
         return confirm("Are you sure you want to delete this exercise?");
      });
   
   }); 
   
   </script>
   
<div class="container">
   <a class="btn btn-primary" href="/exercises">All exercises</a><br>
   <div class="container rounded border border-dark pb-2 mt-2" style="background-color: rgb(180, 234, 255)">
      <h1>{{$exercise->name}}</h1>
      Equipment:
      <ul>
         <li>{{$exercise->equipment->name}}</li>
      </ul>
      Bodyparts:
      <ul>
         @foreach ($exercise->bodyparts as $bodypart)
         <li>{{$bodypart->name}}</li>
      @endforeach
      </ul>

      <a class="btn btn-primary btn-sm" href="/exercises/{{$exercise->id}}/edit">Edit</a>
      <div class="d-inline-block">
         <form class="delExercise" action="/exercises/{{$exercise->id}}" method="POST">
         @csrf
         @method('DELETE')
         <button class="btn btn-danger btn-sm" type="submit" title="delete">Delete</button>
         </form>
      </div>
   </div>   
</div>

@endsection