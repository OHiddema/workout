@extends('layouts.app')

@section('content')

<script>
   $(function(){
      if ($('#rating').val() < 1) {$('#star1').addClass('checked');}
      if ($('#rating').val() < 2) {$('#star2').addClass('checked');}
      if ($('#rating').val() < 3) {$('#star3').addClass('checked');}
      if ($('#rating').val() < 4) {$('#star4').addClass('checked');}
      if ($('#rating').val() < 5) {$('#star5').addClass('checked');}
   
      $('#star1').click(function() {
         $('#star1').removeClass('checked');
         $('#star2,#star3,#star4,#star5').addClass('checked');
         $('#rating').val(1);
      })
      $('#star2').click(function() {
         $('#star1,#star2').removeClass('checked');
         $('#star3,#star4,#star5').addClass('checked');
         $('#rating').val(2);
      })
      $('#star3').click(function() {
         $('#star1,#star2,#star3').removeClass('checked');
         $('#star4,#star5').addClass('checked');
         $('#rating').val(3);
      })
      $('#star4').click(function() {
         $('#star1,#star2,#star3,#star4').removeClass('checked');
         $('#star5').addClass('checked');
         $('#rating').val(4);
      })
      $('#star5').click(function() {
         $('#star1,#star2,#star3,#star4,#star5').removeClass('checked');
         $('#rating').val(5);
      })
    }); 
</script>

<div class="container">
   <h1>Edit Workout</h1>
   <form action="/workouts/{{$workout->id}}" method="post">
      @csrf
      @method('PUT')
   
      <div class="form-group">
         <label for="date">Name</label>
         <input
            type="date"
            name="date"
            id="date"
            class="form-control"
            value="{{old('date',$workout->date)}}">
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
            value="{{old('rating',$workout->rating)}}"
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
         >{{old('remarks',$workout->remarks)}}</textarea>
         @error('remarks')
            <p class="alert alert-danger">{{$errors->first('remarks')}}</p>
         @enderror
      </div>

      <button class="btn btn-primary" type="submit">Submit</button>
      <a class="btn btn-primary" href="/workouts/{{$workout->id}}">Decline</a>
   </form>
</div>
   
@endsection