<script>
    $(document).ready(function(){
    $("#selectProduct").on('change', function(){
        var productId = $(this).val();

        if(productId){
            $.ajax({
                url: "{{ route('invoice.getProduct', ['product' => '__productId__']) }}"
                    .replace('__productId__', productId),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Set the product ID in the hidden input field
                    addRowToTable(response.name, response.price, response.id);
                },
                error: function(error) {

                }
            });
        }
    });

    $(document).on('click', '.delete-row', function(){
        var currentRow = $(this).closest('tr');

        currentRow.remove();
        calculateTotal();
    });

    $(document).on('input', '.invoice_product_qty, .invoice_product_price', function() {
        calculateSubtotal($(this).closest('tr'));
        calculateTotal();
    });

    function addRowToTable(productName, productPrice, productId) {
        var tableBody = $("#invoiceBody");

        var newRow = $("<tr class='invoice-row'>");

        var data = {
            'product_id': productId,
            'price': productPrice || 0,
            'quantity': 1,
            'subtotal': productPrice || 0,
        };

        newRow.append("<td class='text-right'>" +
            "<div class='product-suggestions-container'>" + productName + "</div>" +
            "<input type='hidden' name='invoice_products[][product_id]' value='" + data.product_id + "'>" +
            "</td>");

        newRow.append("<td class='text-right'>" +
            "<div class='input-group no-margin-bottom'>" +
            "<input type='number' class='form-control rounded calculate-sub invoice_product_qty calculate' " +
            "name='invoice_products[][quantity]' value='" + data.quantity + "'>" +
            "</div>" +
            "</td>");

        newRow.append("<td class='text-right'>" +
            "<div class='input-group no-margin-bottom rounded'>" +
            "<span class='input-group-addon' id='currencySymbol'>$</span>" +
            "<input type='number' class='form-control calculate-sub invoice_product_price required' " +
            "name='invoice_products[][price]' aria-describedby='sizing-addon1' placeholder='0.00' " +
            "value='" + data.price + "' readonly>" +
            "</div>" +
            "</td>");

        newRow.append("<td class='text-right'>" +
            "<div class='input-group'>" +
            "<span class='input-group-addon' id='currencySymbol'>$</span>" +
            "<input type='text' class='form-control calculate-sub invoice_product_sub_total' " +
            "name='invoice_products[][subtotal]' value='" + data.subtotal + "' aria-describedby='sizing-addon1'>" +
            "</div>" +
            "</td>");

        newRow.append("<td class='text-right'>" +
            "<div class='-sm d-flex align-items-center'>" +
            "<a href='#' class='btn btn-danger btn-xs delete-row'><i class='fas fa-times' aria-hidden='true'></i></a>" +
            "</div>" +
            "</td>");

        tableBody.append(newRow);
        calculateSubtotal(newRow);
        calculateTotal();
    }

    function calculateSubtotal(row) {
        var quantity = row.find('.invoice_product_qty').val();
        var price = row.find('.invoice_product_price').val();
        var subtotal = (quantity * price).toFixed(2);

        row.find('.invoice_product_sub_total').val(subtotal);
    }

    function calculateTotal() {
        var total = 0;

        $('.invoice_product_sub_total').each(function () {
            var subtotal = parseFloat($(this).val()) || 0;
            total += subtotal;
        });

        $('#sub_total').val(total.toFixed(2));
    }


    let form = $('#invoiceForm');
    $('#create').click(function(){
        // Manually construct the array of arrays
        var dataArray = [];

        $('.invoice-row').each(function(index) {
            var product_id = $(this).find('input[name^="invoice_products"][name$="[product_id]"]').val();
            var quantity = $(this).find('input[name^="invoice_products"][name$="[quantity]"]').val();
            var price = $(this).find('input[name^="invoice_products"][name$="[price]"]').val();
            var subtotal = $(this).find('input[name^="invoice_products"][name$="[subtotal]"]').val();

            dataArray.push({
                'product_id': product_id,
                'quantity': quantity,
                'price': price,
                'subtotal': subtotal
            });
        });

        console.log(dataArray);

        $.ajax({
            url: "{{ route('invoice.store') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                '_token': form.find('input[name="_token"]').val(),
                'date': form.find('input[name="date"]').val(),
                'customer_id': form.find('select[name="customer_id"]').val(),
                'invoice_products': dataArray,
                'sub_total': $('#sub_total').val()
            },
            success: function(response) {
                form.trigger('reset');
                $('#invoiceBody').empty(); 
                Swal.fire('Success!', response.message, 'success');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
