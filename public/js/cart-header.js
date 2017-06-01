$( document ).ready(function(){
  $.post('/cart/quantity').done(function( data ) {
    $('.badge').html(data);
  });
  $('.buy').on('click',function () {
    $.post('/cart', { productId: $(this).data("id") }).done(function( data ) {
      $('.badge').html(data);
    });
  })
});