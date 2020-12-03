@extends('layouts.app')

@section('content')

<div class="container">

   <h1>All Exercises</h1>

   <div class="mb-2">
      <a class="btn btn-primary" href="/exercises/create">Create new exercise</a>
   </div>

   <table class="table table-sm">
      <thead class="thead-light">
         <tr>
            <th>Exercise</th>
            <th>Equipment</th>
            <th>Bodyparts</th>
         </tr>
      </thead>
      <tbody>
         @forelse ($exercises as $exercise)
            <tr>
               <td><a href="/exercises/{{$exercise->id}}">{{ $exercise->name}}</a></td>
               <td>{{$exercise->equipment->name}}</td>
               <td>
                  @foreach ($exercise->bodyparts as $bodypart)
                     {{$bodypart->name}}
                  @endforeach   
               </td>
            </tr>
         @empty
            <tr>
               <td>
                  No exercises found!
               </td>
            </tr>
         @endforelse
      </tbody>
   </table>

</div>

@endsection