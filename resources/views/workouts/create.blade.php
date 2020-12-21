@extends('layouts.app')

@section('content')

<script src="{{ asset('js/script.js') }}"></script>

<script>
   $(function(){
      handleRating();
   }); 
</script>

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
            value="{{old('date',date('Y-m-d',date_timestamp_get(date_create())))}}">
            @error('date')
               <p class="alert alert-danger">{{$errors->first('date')}}</p>
            @enderror
      </div>

      <div class="form-group">
         <label for="rating">Rating</label>
         <input 
            type="number"
            name="rating"
            id="rating"
            value="{{old('rating',3)}}"
            hidden>
         <br>
         <span class="fa fa-star" id="star1"></span>
         <span class="fa fa-star" id="star2"></span>
         <span class="fa fa-star" id="star3"></span>
         <span class="fa fa-star" id="star4"></span>
         <span class="fa fa-star" id="star5"></span>
         @error('rating')
            <p class="alert alert-danger">{{$errors->first('rating')}}</p>
         @enderror
      </div>

      <div class="form-group">
         <label for="remarks">Remark(s)</label>
         <br>
         <textarea
            name="remarks"
            id="remarks"
            class="form-control"
         >{{old('remarks')}}</textarea>
         @error('remarks')
            <p class="alert alert-danger">{{$errors->first('remarks')}}</p>
         @enderror
      </div>
         
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>

@endsection