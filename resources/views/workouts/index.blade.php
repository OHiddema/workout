@extends('layouts.app')

@section('content')

<div class="container">

   <div class="text-center">
      <a class="btn btn-primary mb-2" href="/workouts/create">Create new workout</a>
   </div>

   <form id="monthswitch" class="p-2 mb-2 rounded border border-dark" action="/workouts" method="get" style="background-color: rgb(180, 234, 255)">

      <input type="hidden" id="months" name="months" value="{{$months}}">

      <div class="text-center">
         <button
            type="button"
            onclick="
               // event.preventDefault();
               $('#months').val(parseInt($('#months').val())-1);
               $('#monthswitch').submit();">
            <
         </button>
         <span>{{$header}}</span>
         <button
            type="button"
            onclick="
               // event.preventDefault();
               $('#months').val(parseInt($('#months').val())+1);
               $('#monthswitch').submit();">
            >
         </button>
      </div>

   </form>

   <div class="text-center">
      @forelse ($workouts as $workout)
         <a class="d-block" href="/workouts/{{$workout->id}}">{{date('D d-m-Y', strtotime($workout->date))}}</a>
      @empty
          No workouts found!
      @endforelse
   </div>

</div>

@endsection

