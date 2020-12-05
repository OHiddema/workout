@extends('layouts.app')

@section('content')

<div class="container">
   <h1>New Exercise</h1>
   <form action="/exercises" method="post">
      @csrf
   
      <div class="form-group">
         <label for="name">Name</label>
         <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="{{old('name')}}">
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
            required
         >
            <option value="">Choose equipment:</option>
            @foreach ($equipments as $equipment)
               <option value="{{$equipment->id}}">{{$equipment->name}}</option>
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
            required
         >
            @foreach ($bodyparts as $bodypart)
               <option value="{{$bodypart->id}}">{{$bodypart->name}}</option>
            @endforeach
         </select>
         @error('bodyparts')
            <p class="alert alert-danger">{{$errors->first('bodyparts')}}</p>
         @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>
      <a class="btn btn-primary" href="{{ url()->previous() }}">Decline</a>
   </form>   
</div>

@endsection