<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sale Shortcut</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Barcode Scan</label>
                    <div class="input-groupicon">

                        <input type="text" id="search" onfocus="showResult()" onblur="hideResult()"
                            placeholder="Scan Barcode...">

                    </div>
                </div>
            </div>
            <div id="suggestProduct"></div>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>

                        <th>Stock</th>

                        <th>Price</th>
                        <th>Quantity</th>

                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <br>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
    $("body").on("keyup", "#search", function() {
        let searchData = $("#search").val();
        let token = "{{ csrf_token() }}";
        var route = "{{route('find.products.sales')}}";
        if (searchData.length > 0) {
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    search: searchData,
                    // _token:token,
                },
                success: function(result) {
                    $('#suggestProduct').html(result)
                }
            });
        }
        if (searchData.length < 1) $('#suggestProduct').html(" ");
    });

    function testClick(product) {

        var htmldata = `<tr>
                <input type="hidden" name="product_id[]"  class="form-control product_id"  value="${product.id}">

                <td >

                <a href="javascript:void(0);">${product.name}</a>
               </td>
               <td>${product.qty}</td>

               <td>
                    <input type="text" name="price[]" class="price" value="${product.price}" style="width:100px;">
                    </td>




                <td>
                <input type="text" name="quantity[]" class="form-control quantity"  placeholder="quantity" value="0" style="width:100px;" >
                </td>


                <td class="text-end" >
                <input type="text" class="inline_total" readonly name="sub_total[]" value="${product.purchase_price}" style="width:100px;">
                </td>
                <td>
                    <a class="remove">Delete</a>
                </td>
            </tr>`

        $('table tbody').append(htmldata);

        updateGrandTotal();

    }

    //delete row
    $("table tbody").delegate(".remove", "click", function() {
        $(this).parent().parent().remove();
        updateGrandTotal();
    });
    </script>

    <script>
    function showResult() {
        $('#suggestProduct').slideDown(1000);
    }

    function hideResult() {
        $('#suggestProduct').slideUp(1000);

    }
    </script>

</body>

</html>