@extends('layouts.app')

@section('content')

<script>

$(function(){

   // After validation, return the same number of rows/sets
   aantal = $("#nsets").val();
   for (let i = parseInt(aantal)+1; i <= 10; i++) {
      $("#setsreps tr:nth-child(" + i + ")").hide();
   }

}); 

   function oneRowLess() {
      $aantal = $("#nsets").val();
      if ($aantal>1) {
         $("#setsreps tr:nth-child(" + $aantal + ")").hide();

         // remove input values of row to hide
         $("#setsreps tr:nth-child(" + $aantal + ") td input").val('');

         $aantal--;
         $("#nsets").val($aantal);
      }
   }

   function oneRowMore() {
      $aantal = $("#nsets").val();
      if ($aantal<10) {
         $aantal++;
         $("#setsreps tr:nth-child(" + $aantal + ")").show();
         $("#nsets").val($aantal);
      }
   }
</script>

<div class="container">
   <h1>Add exercise to workout</h1>
   <form action="/workoutlogs" method="post">
      @csrf

      <input type="hidden" name="workout_id" id="workout_id" value="{{$workout->id}}">

      <!-- Show 3 sets when page is loaded for the first time -->
      <input type="hidden" name="nsets" id="nsets" value="{{old('nsets','3')}}">

      <div class="form-group">
         {{-- <label for="exercise_id">Tags</label> --}}
         <select
            name="exercise_id"
            id="exercise_id"
            class="form-control"
            required
         >
            <option value="">Kies een oefening:</option>
            @foreach ($exercises as $exercise)
               <option value="{{$exercise->id}}">{{$exercise->name}}</option>
            @endforeach
         </select>
         @error('exercise_id')
            <p class="alert alert-danger">{{$errors->first('exercise_id')}}</p>
         @enderror
      </div>

      <div class="container">
         <div class="row">
            <div class="col-8">
               <table class="table table-sm">
                  <thead class="thead-light">
                     <tr>
                        <th>Set</th>
                        <th>reps</th>
                        <th>kg</th>
                     </tr>
                  </thead>
                  <tbody id="setsreps">
                     @for ($i = 0; $i < 10; $i++)
                     {{-- @for ($i = 0; $i < old('nsets','10'); $i++) --}}
                        <tr>
                           <td>{{$i+1}}</td>
                           <td><input
                              type="number"
                              min="1"
                              max="100"
                              name="reps[{{$i}}]"
                              id="reps{{$i}}"
                              class="form-control"
                              value='{{old("reps.".$i)}}'>
                           </td>
                           <td><input
                              type="text"
                              name="weight[{{$i}}]"
                              id="weight{{$i}}"
                              class="form-control"
                              value='{{old("weight.".$i)}}'>
                           </td>
                        </tr>
                     @endfor
                  </tbody>
               </table>
            </div>
            <div class="col-4">
               <div class="mb-2">
                  <button type="button" onclick="oneRowLess()">-</button> Set
               </div>
               <div class="mb-2">
                  <button type="button" onclick="oneRowMore()">+</button> Set
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </div>
      </div>

      @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               {{-- @for ($i = 0; $i < 10; $i++) --}}
               @for ($i = 0; $i < old('nsets','10'); $i++)
                  @error('reps.'.$i)
                     <li>{{$errors->first('reps.'.$i)}}</li>
                  @enderror
                  @error('weight.'.$i)
                     <li>{{$errors->first('weight.'.$i)}}</li>
                  @enderror          
               @endfor
            </ul>
         </div>
      @endif
         
   </form>

</div>
@endsection