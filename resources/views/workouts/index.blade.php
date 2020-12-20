@extends('layouts.app')

@section('content')

<style>
*,
*:before,
*:after {
  box-sizing: border-box;
}
table {
  clear: both;
  width: 100%;
  border: 1px solid #dcdcff;
  border-radius: 3px;
  border-collapse: collapse;
}
td {
  height: 48px;
  text-align: center;
  vertical-align: middle;
  border-right: 1px solid #dcdcff;
  border-top: 1px solid #dcdcff;
  width: 14.28571429%;
}
td.not-current {
  color: #c0c0c0;
}
td.today {
  font-weight: 700;
  color: #28283b;
  background-color: chartreuse;
}
thead td {
  border: none;
  color: #28283b;
  text-transform: uppercase;
  font-size: 1.5em;
}
#btnPrev {
  float: left;
  margin-bottom: 20px;
}
#btnPrev:before {
  content: '\f104';
  font-family: FontAwesome;
  padding-right: 4px;
}
#btnNext {
  float: right;
  margin-bottom: 20px;
}
#btnNext:after {
  content: '\f105';
  font-family: FontAwesome;
  padding-left: 4px;
}
#btnPrev,
#btnNext {
  background: transparent;
  border: none;
  outline: none;
  font-size: 1em;
  color: #c0c0c0;
  cursor: pointer;
  font-family: "Roboto Condensed", sans-serif;
  text-transform: uppercase;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
#btnPrev:hover,
#btnNext:hover {
  color: #28283b;
  font-weight: bold;
}
.trainingDay a{
  font-weight: 900;
  color: blue;
}
</style>

<div class="container">

  <div class="text-center">
    <a class="btn btn-primary mb-2" href="/workouts/create">Create new workout</a>
  </div>

  <form id="monthswitch" action="/workouts" method="get" style="display: none">
    <input type="hidden" id="months" name="months" value="{{$months}}">
  </form>

  <button id="btnNext" type="button">Next</button>
  <button id="btnPrev" type="button">Prev</button>
  <div id="divCal"></div>

</div>

<script>

// returns alternative day of the week,
// where Mon = 0, Tue = 1, ... Sun = 6, instead of Sun = 0, Mon = 1, ... Sat = 6
Date.prototype.alt_getDay = function () {
  return (this.getDay() + 6) % 7;
};

var Cal = function(divId) {

  //Store div id
  this.divId = divId;

  // Days of week, starting on Monday
  this.DaysOfWeek = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

  // Months, stating on January
  this.Months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];

  // Set the current month, year
  var d = new Date();
  d.setMonth( d.getMonth() + <?php echo $months ?> );
  this.currMonth = d.getMonth();
  this.currYear = d.getFullYear();
  this.currDay = d.getDate();

};

// Goes to next month
Cal.prototype.nextMonth = function() {
  $('#months').val(parseInt($('#months').val())+1);
  $('#monthswitch').submit();
};

// Goes to previous month
Cal.prototype.previousMonth = function() {
  $('#months').val(parseInt($('#months').val())-1);
  $('#monthswitch').submit();
};

// Show current month
Cal.prototype.showcurr = function() {
  this.showMonth(this.currYear, this.currMonth);
};

// Show month (year, month)
Cal.prototype.showMonth = function(y, m) {

  var d = new Date()
  // First day of the week in the selected month
  , firstDayOfMonth = new Date(y, m, 1).alt_getDay()
  // Last day of the selected month
  , lastDateOfMonth =  new Date(y, m+1, 0).getDate()
  // Last day of the previous month
  , lastDayOfLastMonth = m == 0 ? new Date(y-1, 12, 0).getDate() : new Date(y, m, 0).getDate();


  var html = '<table>';

  // Write selected month and year
  html += '<thead><tr>';
  html += '<td colspan="7">';
  html += this.Months[m] + ' ' + y;
  html += '</td>';
  html += '</tr></thead>';


  // Write the header of the days of the week
  html += '<tr class="days">';
  for(var i=0; i < this.DaysOfWeek.length;i++) {
    html += '<td>' + this.DaysOfWeek[i] + '</td>';
  }
  html += '</tr>';

  // Write the days
  var i=1;
  do {

    var dow = new Date(y, m, i).alt_getDay();

    // If Monday, start new row
    if ( dow == 0 ) {
      html += '<tr>';
    }
    // If not Monday but first day of the month
    // it will write the last days from the previous month
    else if ( i == 1 ) {
      html += '<tr>';
      var k = lastDayOfLastMonth - firstDayOfMonth+1;
      for(var j=0; j < firstDayOfMonth; j++) {
        html += '<td class="not-current">' + k + '</td>';
        k++;
      }
    }

    // Write the current day in the loop
    var chk = new Date();
    var chkY = chk.getFullYear();
    var chkM = chk.getMonth();
    if (chkY == this.currYear && chkM == this.currMonth && i == this.currDay) {
      // ##### added id ##################
      html += '<td class="today" id="day' + i + '">' + i + '</td>';
    } else {
      html += '<td class="normal" id="day' + i + '">' + i + '</td>';
      // ##### added id ##################
    }
    // If Sunday, closes the row
    if ( dow == 6 ) {
      html += '</tr>';
    }
    // If not Sunday, but last day of the selected month
    // it will write the next few days from the next month
    else if ( i == lastDateOfMonth ) {
      var k=1;
      for(dow; dow < 6; dow++) {
        html += '<td class="not-current">' + k + '</td>';
        k++;
      }
    }

    i++;
  }while(i <= lastDateOfMonth);

  // Closes table
  html += '</table>';

  // Write HTML to the div
  document.getElementById(this.divId).innerHTML = html;
};

// On Load of the window
window.onload = function() {

  // Start calendar
  var c = new Cal("divCal");			
  c.showcurr();

  $('#btnNext').on('click',function() {c.nextMonth();});
  $('#btnPrev').on('click',function() {c.previousMonth()});
}

</script>

<!--################## ADDED #########################-->
@foreach ($workouts as $workout)
  <script>
    $(function(){
      d = new Date(<?php echo 1000*strtotime($workout->date) ?>);
      day = d.getDate();
      if ($('#day' + day + ' a').length) {
        $('#day' + day).html($('#day' + day).html() + ', <a href="/workouts/{{$workout->id}}">' + day + '</a>');
      } else {
        $('#day' + day).html('<a href="/workouts/{{$workout->id}}">' + day + '</a>');
      }
      $('#day' + day).addClass('trainingDay');
    }); 
  </script>
@endforeach
<!--################## ADDED #########################-->

@endsection