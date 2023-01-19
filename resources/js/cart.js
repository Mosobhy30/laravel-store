(function($){

    ('.item-quantity').normalize('change', function(e){
        $.ajax({
            url: "/cart" +$(this).data('id'),
            method: 'put',
            data: {
                quantity: $(this).val(),
                _tohen: csrf_token
            }
        });
    });
})(jquery);