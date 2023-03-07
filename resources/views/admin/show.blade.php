<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        h1{
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                    </div>
                @endif

                <h1 class="mx-auto" style="width: 200px; font-size: 20px">All Products</h1>

                <table class="table">
                    <tr class="bg-info">
                        <th class="text-dark">#</th>
                        <th class="text-dark">Title</th>
                        <th class="text-dark">Description</th>
                        <th class="text-dark">Image</th>
                        <th class="text-dark">Category</th>
                        <th class="text-dark">Price</th>
                        <th class="text-dark">Discount Price</th>
                        <th class="text-dark">Quantity</th>
                        <th class="text-dark">Actions</th>
                    </tr>

                    @foreach($product as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <img src="/product_images/{{ $product->image }}">
                            </td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ url('update_product', $product->id) }}">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this Product?')"  class="btn btn-danger" href="{{ url('delete_product', $product->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.script')
</body>
</html>
