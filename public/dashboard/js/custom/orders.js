$('document').ready(function() {
    $('.add-product-btn').on('click', function(e){
        e.preventDefault();
        let name = $(this).data('name');
        let id = $(this).data('id');
        let price = $(this).data('price');

        $(this).removeClass('btn-success').addClass('btn-default disabled');

        let html =
            `<tr>
                <td style="vertical-align: middle">${name}</td>
                <td style="vertical-align: middle"><input type="number" name="quanities[]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price" style="vertical-align: middle">${price}</td>
                <td style="vertical-align: middle"><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.order-list').append(html);
        calculateTotal();
    });

    $('body').on('click', '.disabled', function(e) {
        e.preventDefault();
    });//end of disabled

    $('body').on('click', '.remove-product-btn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
        calculateTotal();
    });

    let quantity = parseInt($(this).val()); //2
    let unitPrice = $(this).data('price'); //150
    $(this).closest('tr').find('.product-price').html(quantity * unitPrice);
    $('body').on('change', '.product_quantity', function(){
        calculateTotal();
    });

    $('body').on('keyup change', '.product-quantity', function() {
        let quantity = parseInt($(this).val()); //2
        let unitPrice = $(this).data('price'); //150
        $(this).closest('tr').find('.product-price').html(quantity * unitPrice);
        calculateTotal();
    });//end of product quantity change

});

function calculateTotal() {
    let price = 0;
    $('.order-list .product-price').each(function(index){
        price += parseInt($(this).html());
    });

    $('.total-price').html(price);

}
