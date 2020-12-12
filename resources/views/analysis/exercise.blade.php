@extends('layouts.app')

@section('content')

<div class="container">

   <form id="filterform" class="p-2 mb-2 rounded border border-dark" action="/analysis/exercise" method="get" style="background-color: rgb(180, 234, 255)">

      <div class="row align-items-center">
         <div class="col">
            <div class="form-group">
               <label for="equipment">Filter exercises on equipment used:</label>
               <select
                  name="equipment"
                  id="equipment"
                  class="form-control"
                  {{-- onchange="event.preventDefault();document.getElementById('filterform').submit();"> --}}
                  onchange="event.preventDefault();$('#filterform').submit();">
                  <option value="0">All</option>
                  @foreach ($equipments as $equipment)
                     <option value="{{$equipment->id}}"
                     @if ($equipment->id == $oldequipment)
                        selected
                     @endif"
                     >{{$equipment->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col">
            <div class="form-group">
               <label for="bodypart">Filter exercises on bodypart used:</label>
               <select
                  name="bodypart"
                  id="bodypart"
                  class="form-control"
                  {{-- onchange="event.preventDefault();document.getElementById('filterform').submit();"> --}}
                  onchange="event.preventDefault();$('#filterform').submit();">
                  <option value="0">All</option>
                  @foreach ($bodyparts as $bodypart)
                     <option value="{{$bodypart->id}}"
                     @if ($bodypart->id == $oldbodypart)
                        selected
                     @endif"
                     >{{$bodypart->name}}</option>
                  @endforeach
               </select> 
            </div>                  
         </div>
      </div>

      <div class="row align-items-center">
         <div class="col">
            <div class="form-group">
               <label for="exercise">Choose exercise:</label>
               <select
                  name="exercise"
                  id="exercise"
                  class="form-control"
                  onchange="event.preventDefault();document.getElementById('filterform').submit();">
                  <option value="">Choose an exercise:</option>
                  @foreach ($exercises as $exercise)
                     <option value="{{$exercise->id}}"
                     @if ($exercise->id == $exercise_id)
                        selected
                     @endif"
                     >{{$exercise->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
      </div>

   </form>

   @if ($exercise_id > 0)
      <table class="table table-sm" id="myTable">
         <thead class="thead-light" style="text-align: center">
            <tr>
               <th>Training date</th>
               @for ($i = 1; $i <= $maxSets; $i++)
                  <th>Set {{$i}}</th>
               @endfor
            </tr>
         </thead>
         <tbody>
            @foreach ($workouts as $workout)
               @foreach ($workout->workoutlogs as $workoutlog)
                  @if ($workoutlog->exercise_id == $exercise_id)
                     <tr>
                        <td>
                           {{date('d-m-Y', strtotime($workout->date))}}
                        </td>
                        @foreach ($workoutlog->sets as $set)
                           <td>
                              {{$set->reps}}x{{$set->weight}}
                           </td>
                        @endforeach
                     </tr>
                  @endif                  
               @endforeach
            @endforeach
         </tbody>
      </table>       
   @endif

   <div id="linechart"></div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

   // Make chart responsive
   $(function(){
      $(window).resize(function(){
         lineChart();
      });
   }); 

   var graphData = <?php echo $graphData; ?>;
   google.charts.load('current', {
      'packages': ['corechart']
   });
   google.charts.setOnLoadCallback(lineChart);

   function lineChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('datetime', 'date');
      data.addColumn('number', 'oneRM');
      for (i=0;i<graphData.length;i++) {
         data.addRows([[new Date(graphData[i][0]), graphData[i][1]]]);
      }
      
      var options = {
      
         hAxis: {
            title: 'Date',
            format: 'd MMM yy'
         },

         vAxis: {
            title: 'Estimated 1RM',
            minValue: 0
         },

         title: 'Estimated 1RM progression over time',

         titleTextStyle: {
            fontSize: 24,
         },

         legend: {
            position: 'none'
         },

         pointSize: 5,
         width:$('#myTable').width(),
         height:$('#myTable').width()*0.5,

      };

      var chart = new google.visualization.LineChart(document.getElementById('linechart'));
      chart.draw(data, options);
   }        
</script>  

@endsection