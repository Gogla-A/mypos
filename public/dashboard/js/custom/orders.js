$('document').ready(function() {
    //Add Product Button
    $('.add-product-btn').on('click', function(e){
        e.preventDefault();
        let name = $(this).data('name');
        let id = $(this).data('id');
        let price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled');

        let html =
            `<tr>
<!--                <input type="hidden" name="products[]" value="${id}">-->
                <td style="vertical-align: middle">${name}</td>
                <td style="vertical-align: middle"><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price" style="vertical-align: middle">${price}</td>
                <td style="vertical-align: middle"><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;

        $('.order-list').append(html);
        calculateTotal();
    });

    //Disabled Button
    $('body').on('click', '.disabled', function(e) {
        e.preventDefault();
    });//End Of Disabled

    //Remove Product Button
    $('body').on('click', '.remove-product-btn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
        calculateTotal();
    }); //End Of Remove Product Button

    //Change Product Quantity
    $('body').on('keyup change', '.product-quantity', function() {
        let quantity = parseInt($(this).val()); //2
        let unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice, 2));
        calculateTotal();
    }); //End Of Change Product Quantity

    //List All Order Products
    $('.order-products').on('click', function(e) {
        e.preventDefault();
        $('#loading').css('display', 'flex');

        let url = $(this).data('url');
        let method = $(this).data('method');

        $.ajax({
            url: url,
            method: method,
            success: function(data){
                $('#loading').css('display', 'none');
                $('#order-product-list').show().empty().append(data);

            }
        })
    }); //End Of List All Order Products

}); //End Of Document Ready

//Print Order
$(document).on('click', '.print-btn', function() {
    $('#print-area').printThis();
})

// //Close Order
$(document).on('click', '.close-btn', function() {
    $('#order-product-list').hide();
}) //End Close Order List

//Total Calculations
function calculateTotal() {
    let price = 0;
    $('.order-list .product-price').each(function(index){
        price += parseFloat($(this).html().replace(/,/g, ''));
    });

    $('.total-price').html($.number(price, 2));

    if (price > 0) {
        $('#add-order-btn').removeClass('disabled');
    }else{
        $('#add-order-btn').addClass('disabled');
    }

} //End Of Total Calculations
