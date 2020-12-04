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

         // copy data of last set when adding an extra set
         $("#reps" + parseInt($aantal-1)).val($("#reps" + parseInt($aantal-2)).val());
         $("#weight" + parseInt($aantal-1)).val($("#weight" + parseInt($aantal-2)).val());

         $("#nsets").val($aantal);
      }
   }
</script>

@yield('maincontent')
@endsection