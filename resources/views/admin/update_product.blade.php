<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        .div_center{
            text-align: center;
            padding-top: 40px;
        }

        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color{
            color: black;
            padding-bottom: 20px;
        }

        label{
            display: inline-block;
            width: 200px;
        }

        .div_design{
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

                <div class="div_center">

                    <h1 class="font_size">Update Product</h1>

                    <form action="{{ url('/update_product_confirm', $product->id) }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="div_design">
                            <label>Product Title :</label>
                            <input class="text_color" type="text" name="title" value="{{ $product->title }}" placeholder="Product Title" required>
                        </div>

                        <div class="div_design">
                            <label>Product Description :</label>
                            <input class="text_color" type="text" name="product_description" value="{{ $product->description }}" placeholder="Product Description" required>
                        </div>

                        <div class="div_design">
                            <label>Product Price :</label>
                            <input class="text_color" type="number" name="product_price" value="{{ $product->price }}" placeholder="Product price" required>
                        </div>

                        <div class="div_design">
                            <label>Discount Price :</label>
                            <input class="text_color" type="number" name="dis_price" value="{{ $product->discount_price }}" placeholder="Discount Price">
                        </div>

                        <div class="div_design">
                            <label>Product Quantity :</label>
                            <input class="text_color" type="number" name="product_quantity" value="{{ $product->quantity }}" placeholder="Product quantity" required>
                        </div>

                        <div class="div_design">
                            <label>Product Category :</label>
                            <select class="text_color" name="product_category" required>

                                <option value="{{ $product->category }}" selected="">{{ $product->category }}</option>

                                @foreach($category as $category)
                                    <option value="{{ $category->getAttributeValue('category_name') }}">{{ $category->getAttributeValue('category_name') }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="div_design">
                            <label>Current Product Image :</label>
                            <img style="margin: auto" height="100" width="100"
                                 src="/product_images/{{ $product->image }}" alt="">
                        </div>

                        <div class="div_design">
                            <label>Change Product Image :</label>
                            <input type="file" name="image">
                        </div>

                        <div class="div_design">
                            <input type="submit" name="" value="Update Product" class="btn btn-primary">
                        </div>


                    </form>

                </div>

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
