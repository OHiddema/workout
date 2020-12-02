@extends('layouts.workoutlogs')

@section('maincontent')

<div class="container">
   <h1>Edit workout exercise</h1>
   <form action="/workoutlogs/{{$workoutlog->id}}" method="post">
      @csrf
      @method('PUT')
      
      {{-- Is dit eigenlijk nog wel nodig ????? --}}
      <input type="hidden" name="workout_id" id="workout_id" value="{{$workoutlog->workout->id}}">

      <!-- nsets == number of sets in workoutlog, when page is loaded for first time -->      
      <input type="hidden" name="nsets" id="nsets" value="{{old('nsets',$workoutlog->sets->count())}}">

      <div class="form-group">
         <select
            name="exercise_id"
            id="exercise_id"
            class="form-control"
            required
         >
            <option value="">Kies een oefening:</option>
            @foreach ($exercises as $exercise)
               <option value="{{$exercise->id}}"
                  @if ( $exercise->id == old("exercise_id",$workoutlog->exercise_id))
                     selected
                  @endif"
               >{{$exercise->name}}</option>
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
                        <tr>
                           <td>{{$i+1}}</td>
                           <td><input
                              type="number"
                              min="1"
                              max="100"
                              name="reps[{{$i}}]"
                              id="reps{{$i}}"
                              class="form-control"
                              @if ($i < $workoutlog->sets->count())
                                 value='{{old("reps.".$i, $workoutlog->sets[$i]->reps)}}'    
                              @else
                                 value='{{old("reps.".$i)}}'
                              @endif
                              >
                           </td>
                           <td><input
                              type="text"
                              name="weight[{{$i}}]"
                              id="weight{{$i}}"
                              class="form-control"
                              @if ($i < $workoutlog->sets->count())
                                 value='{{old("weight.".$i, $workoutlog->sets[$i]->weight)}}'    
                              @else
                                 value='{{old("weight.".$i)}}'
                              @endif
                              >
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