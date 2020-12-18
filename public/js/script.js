function handleRating() {
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
}