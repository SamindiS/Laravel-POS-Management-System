@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light fw-bold" style="float: left;">Add Products</h4>
                    <button class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addproduct">
                        <i class="fa fa-plus"></i> Add New Products
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                               
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Alert Stock</th>
                        
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class=>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{number_format($product->price,2)}}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>@if($product->alert_stock>=$product->quantity) <span class="badge bg-danger">Low Stock > {{$product->alert_stock}}</span> 
                                    @else <span class="badge bg-success">{{$product->alert_stock}}</span>
                                     @endif</td>
                                
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editproduct{{ $product->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproduct{{ $product->id }}">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                     {{-- Edit product Modal --}}
             <div class="modal right fade" id="editproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">
                  <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                                                                      @csrf
                                                                      @method('PUT')
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" name="product_name" id="" value="{{ $product->product_name }}" class="form-control" >
                                                </div>
                            
                     <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" name="brand" id="" value="{{ $product->brand}}"  class="form-control" >
                                                </div>
                            
                 <div class="form-group">
                 <label for="">Price</label>
                 <input type="number" name="price" id="" value="{{ $product->price}}" class="form-control" >
               </div>
                            
                <div class="form-group">
                 <label for="">Quantity</label>
                <input type="number" name="quantity" id="" value="{{ $product->quantity}}" class="form-control" >
                </div>
                            
                <div class="form-group">
                <label for=""> Alert Stock</label>
                <input type="number" name="alert_stock" id="" value="{{ $product->alert_stock}}" class="form-control" >
                 </div>
                                                
                                                
                <div class="form-group">
              <label for="">Description</label>
             <textarea name="description" id="" cols="30" rows="2" class="form-control" >{{ $product->description}}
                     </textarea>
                 </div>
                                              
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                              </div>
                         </form>                 
                    </div>
                 </div>
                </div>
             </div>

          {{-- Delete product Modal --}}
          <div class="modal right fade" id="deleteproduct{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                           <p>Are you sure you want to delete this {{ $product->product_name }}?</p>
                            
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" data-bs-dismiss="modal">Cancel</button>

                                <button type="submit" class="btn btn-danger" >Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    

                            @endforeach
                        </tbody>
                        <div class="d-flex justify-content-left mt-2">
                            {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                        
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar: Search product -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-light ">Search product</h4>
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
