@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Add exercise to workout</h1>
   <form action="/workoutlogs" method="post">
      @csrf

      <input type="hidden" name="workout_id" id="workout_id" value="{{$workout->id}}">

      <div class="form-group">
         <label for="exercise_id">Tags</label>
         <select
            name="exercise_id"
            id="exercise_id"
            class="form-control"
         >
            @foreach ($exercises as $exercise)
               <option value="{{$exercise->id}}">{{$exercise->name}}</option>
            @endforeach
         </select>
         @error('exercise_id')
            <p class="alert alert-danger">{{$errors->first('exercise_id')}}</p>
         @enderror
      </div>

      <table class="table table-sm">
         <thead class="thead-light">
            <tr>
               <th></th>
               <th>reps</th>
               <th>kg</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Set 1</td>
               <td><input type="number" name="reps[]" id="reps1" class="form-control" value="{{old('reps.0')}}" required></td>
               <td><input type="text" name="weight[]" id="weight1" class="form-control" value="{{old('weight.0')}}" required></td>
            </tr>
            <tr>
               <td>Set 2</td>
               <td><input type="number" name="reps[]" id="reps2" class="form-control" value="{{old('reps.1')}}" required></td>
               <td><input type="text" name="weight[]" id="weight2" class="form-control" value="{{old('weight.1')}}" required></td>
            </tr>
            <tr>
               <td>Set 3</td>
               <td><input type="number" name="reps[]" id="reps3" class="form-control" value="{{old('reps.2')}}" required></td>
               <td><input type="text" name="weight[]" id="weight3" class="form-control" value="{{old('weight.2')}}" required></td>
            </tr>
         </tbody>
      </table>

      @error('reps.0')
         <p class="alert alert-danger">{{$errors->first('reps.0')}}</p>
      @enderror
      @error('weight.0')
         <p class="alert alert-danger">{{$errors->first('weight.0')}}</p>
      @enderror

      @error('reps.1')
         <p class="alert alert-danger">{{$errors->first('reps.1')}}</p>
      @enderror
      @error('weight.1')
         <p class="alert alert-danger">{{$errors->first('weight.1')}}</p>
      @enderror

      @error('reps.2')
         <p class="alert alert-danger">{{$errors->first('reps.2')}}</p>
      @enderror
      @error('weight.2')
         <p class="alert alert-danger">{{$errors->first('weight.2')}}</p>
      @enderror
         
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>
@endsection