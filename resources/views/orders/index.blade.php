@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light fw-bold" style="float: left;">Order Products</h4>
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addproduct">
                        <i class="fa fa-plus"></i> Add New Products
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        
                        <thead class="table-light">
                            <tr>
                              
                                <th></th>
                                <th>Product Name</th>
                                <th>Qty</th>  
                                <th>Price</th>
                                <th>Dis (%)</th>
                                <th>Total</th>
                                <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i class="fa fa-plus-circle"></i> </a></th>
                    
                            </tr>
                        </thead>
         <tbody class="addMoreProduct">
            <tr>
                <td>1</td>
                <td>
                    <select name="product_id[]" id="product_id" class="form-select product_id" >
                         @foreach ($products as $product)
                         <option data-price="{{ $product->price }}"
                            value="{{ $product->id }}">{{ $product->product_name }}
                        </option>
                        @endforeach
                    </select>  
                </td>
                <td>
                   <input type="number" name="quantity[]" id="quantity" class="form-control quantity"> 
                </td>
                <td>
                    <input type="number" name="price[]" id="price" class="form-control price"> 
                 </td>
                 <td>
                    <input type="number" name="discount[]" id="discount" class="form-control discount"> 
                 </td>
                 <td>
                    <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount"> 
                 </td>
                 <td><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i> </a></td>
            </tr>
      
        </tbody>
                        
                        
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Search product -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 >Total <b class="total">0.00</b></h4>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control" placeholder="Search product...">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Add product -->
<div class="modal right fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" id="" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for=""> Alert Stock</label>
                        <input type="number" name="alert_stock" id="" class="form-control" >
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="2" class="form-control" >
                        </textarea>
                    </div>
                  
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log("jQuery Loaded & Script Running ✅");

        // Get the original dropdown for cloning
        var productDropdown = $('.product_id').first().clone();
        productDropdown.removeAttr('id'); // Remove ID to prevent duplication
        productDropdown.find('option:selected').removeAttr('selected'); // Reset selection

        // Add more rows dynamically
        $(document).on('click', '.add_more', function(e) {
            e.preventDefault(); // Prevent default action

            var numberofrow = $('.addMoreProduct tr').length + 1; // Get current row count

            var tr = `
                <tr>
                    <td>${numberofrow}</td>
                    <td>${productDropdown.prop('outerHTML')}</td>
                    <td><input type="number" name="quantity[]" class="form-control quantity " ></td>
                    <td><input type="number" name="price[]" class="form-control price "></td>
                    <td><input type="number" name="discount[]" class="form-control discount "></td>
                    <td><input type="number" name="total_amount[]" class="form-control total_amount"></td>
                    <td><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times-circle"></i></a></td>
                </tr>`;

            $('.addMoreProduct').append(tr); // Append new row
        });
    });

        // Remove row
        // $(document).on('click', '.delete', function(e) {
        //     e.preventDefault();
        //     $(this).closest('tr').remove();
        // });
        $('.addMoreProduct').delegate('.delete','click',function(){
            $(this).parent().parent().remove();
        })

        // Auto Calculate Total Price
        // $(document).on('input', '.quantity, .price, .discount', function() {
        //     var row = $(this).closest('tr');
        //     var qty = parseFloat(row.find('.quantity').val()) || 0;
        //     var price = parseFloat(row.find('.price').val()) || 0;
        //     var discount = parseFloat(row.find('.discount').val()) || 0;

        //     var total = (qty * price) - ((qty * price * discount) / 100);
        //     row.find('.total').val(total.toFixed(2));
        //});

        function TotalAmount(){
            var total=0;
            $('.total_amount').each(function(i,e){
                var amount=$(this).val()-0;
                total+=amount;
            });

            $('.total_amount').html(total);


        }

        $('.addMoreProduct').delegate('.product_id', 'change', function () {
    var tr = $(this).closest('tr');
    var price = $(this).find('option:selected').attr('data-price');

    tr.find('.price').val(price); // Set price input based on selected product

    var qty = parseFloat(tr.find('.quantity').val()) || 0;
    var disc = parseFloat(tr.find('.discount').val()) || 0;
    price = parseFloat(price) || 0;

    var total_amount = (qty * price) - ((qty * price * disc) / 100);
    tr.find('.total_amount').val(total_amount.toFixed(2));
    TotalAmount();
});


    
</script>
@endsection
