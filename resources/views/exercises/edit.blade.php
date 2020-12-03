@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Edit Exercise</h1>
   <form action="/exercises/{{$exercise->id}}" method="post">
      @csrf
      @method('PUT')
   
      <div class="form-group">
         <label for="name">Name</label>
         <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="{{old('name',$exercise->name)}}">
            @error('name')
               <p class="alert alert-danger">{{$errors->first('name')}}</p>
            @enderror

      </div>

      <div class="form-group">
         <label for="equipment_id">Equipment</label>
         <select
            name="equipment_id"
            id="equipment_id"
            class="form-control"
         >
            @foreach ($equipments as $equipment)
               <option
               @if ($exercise->equipment->id == $equipment->id)
                  selected
               @endif
               value="{{$equipment->id}}">{{$equipment->name}}</option>
            @endforeach
         </select>
         @error('equipment')
            <p class="alert alert-danger">{{$errors->first('equipment')}}</p>
         @enderror
      </div>

      <div class="form-group">
         <label for="bodyparts">Bodyparts</label>
         <select
            name="bodyparts[]"
            id="bodyparts"
            class="form-control"
            multiple
         >
            @foreach ($bodyparts as $bodypart)
               <option
               @if ($exercise->bodyparts->find($bodypart->id) !== null)
                  selected
               @endif
               value="{{$bodypart->id}}">{{$bodypart->name}}</option>
            @endforeach
         </select>
         @error('bodyparts')
            <p class="alert alert-danger">{{$errors->first('bodyparts')}}</p>
         @enderror
      </div>

      <button class="btn btn-primary mt-2" type="submit">Submit</button>
   </form>
</div>

@endsection