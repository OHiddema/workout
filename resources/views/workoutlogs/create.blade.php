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
               <td><input type="number" name="reps1" id="reps1" class="form-control" value="{{old('reps1')}}" required></td>
               <td><input type="number" name="weight1" id="weight1" class="form-control" value="{{old('weight1')}}" required></td>
            </tr>
            <tr>
               <td>Set 2</td>
               <td><input type="number" name="reps2" id="reps2" class="form-control" value="{{old('reps2')}}" required></td>
               <td><input type="number" name="weight2" id="weight2" class="form-control" value="{{old('weight2')}}" required></td>
            </tr>
            <tr>
               <td>Set 3</td>
               <td><input type="number" name="reps3" id="reps3" class="form-control" value="{{old('reps3')}}" required></td>
               <td><input type="number" name="weight3" id="weight3" class="form-control" value="{{old('weight3')}}" required></td>
            </tr>
         </tbody>
      </table>

      @error('reps1')
         <p class="alert alert-danger">{{$errors->first('reps1')}}</p>
      @enderror
      @error('weight1')
         <p class="alert alert-danger">{{$errors->first('weight1')}}</p>
      @enderror

      @error('reps2')
         <p class="alert alert-danger">{{$errors->first('reps2')}}</p>
      @enderror
      @error('kg2')
         <p class="alert alert-danger">{{$errors->first('weight2')}}</p>
      @enderror

      @error('reps3')
         <p class="alert alert-danger">{{$errors->first('reps3')}}</p>
      @enderror
      @error('kg3')
         <p class="alert alert-danger">{{$errors->first('weight3')}}</p>
      @enderror
         
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>
@endsection