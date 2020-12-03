@extends('layouts.app')

@section('content')

<div class="container">

   <h1>All Exercises</h1>

   <div class="mb-2">
      <a class="btn btn-primary" href="/exercises/create">Create new exercise</a>
   </div>

   <form id="filterform" class="p-2 mb-2 rounded border border-dark" action="/exercises" method="get" style="background-color: rgb(180, 234, 255)">
      <div class="container">
         <div class="row align-items-center">
            <div class="col">
               <div class="form-group">
                  <label for="equipment">Choose equipment:</label>
                  <select
                     name="equipment"
                     id="equipment"
                     class="form-control"
                     onchange="event.preventDefault();document.getElementById('filterform').submit();">
                     <option value="0">All</option>
                     @foreach ($equipments as $equipment)
                        <option value="{{$equipment->id}}"
                        @if ($equipment->id == $oldequipment)
                           selected
                        @endif"
                        >{{$equipment->name}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col">
               <div class="form-group">
                  <label for="bodypart">Choose bodypart:</label>
                  <select
                     name="bodypart"
                     id="bodypart"
                     class="form-control"
                     onchange="event.preventDefault();document.getElementById('filterform').submit();">
                     <option value="0">All</option>
                     @foreach ($bodyparts as $bodypart)
                        <option value="{{$bodypart->id}}"
                        @if ($bodypart->id == $oldbodypart)
                           selected
                        @endif"
                        >{{$bodypart->name}}</option>
                     @endforeach
                  </select> 
               </div>                  
            </div>
         </div>
      </div>   
   </form>

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