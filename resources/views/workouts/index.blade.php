@extends('layouts.app')

@section('content')

<div class="container">
   <table class="table table-sm">
      <thead class="thead-light">
         <tr>
            <th>Id</th>
            <th>Date</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($workouts as $workout)
            <tr>
               <td>{{$workout->id}}</td>
               <td><a href="/workouts/{{$workout->id}}">{{$workout->date}}</a></td>
            </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection

