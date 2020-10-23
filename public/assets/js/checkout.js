$(document).ready(function(){
  $('input.payment_method').iCheck({
    checkboxClass: 'icheckbox_square-orange',
    radioClass: 'iradio_square-orange',
    increaseArea: '20%' // optional
  });

  $('#shipping-info-form').validator().on('submit', function (e) {
      if (e.isDefaultPrevented()) {
        //alert('a');
      } else {
        // everything looks good!
      }
    });

  $('.place-order').click(function() {
    $('#shipping-info-form').submit();
      
  });
});