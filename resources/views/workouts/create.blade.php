@extends('layouts.app')

@section('content')

<div class="container">
   <h1>New Training</h1>
   <form action="/workouts" method="post">
      @csrf
   
      <div class="form-group">
         <label for="date">Date</label>
         <input
            type="date"
            name="date"
            id="date"
            class="form-control"
            value="{{old('date')}}">
            @error('date')
               <p class="alert alert-danger">{{$errors->first('date')}}</p>
            @enderror
      </div>
         
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>

@endsection