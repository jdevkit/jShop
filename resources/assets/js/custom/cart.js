$( document ).ready(function(){
  $('.plus').on('click',function () {
    $.post('/cart/quantity/add', { productId: $(this).data("id") }).done(function( data ) {
      $('.summ').html(data.total);
      $('.cart').html(data.cart);
      $('#' + data.id).html(data.quantity);
      $('#summ-' + data.id).html(data.summ)
    });
  })
  $('.minus').on('click',function () {
    $.post('/cart/quantity/deduct', { productId: $(this).data("id") }).done(function( data ) {
      $('.summ').html(data.total);
      $('.cart').html(data.cart);
      $('#' + data.id).html(data.quantity);
      $('#summ-' + data.id).html(data.summ)
    });
  })

  $('.delete-item').on('click',function () {
    $.post('/cart/delete', { productId: $(this).data("id") }).done(function( data ) {
      $('.summ').html(data.total);
      $('.cart').html(data.cart);
      $('#book-' + data.id).hide();
    });
  })

});