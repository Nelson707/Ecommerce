<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style type="text/css">
        .cart-total{
            padding-left: 50px;
            display: flex;
        }
        .cart-summary{
            margin-left: 50px;
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
            <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
        </div>
    @endif

    <div class="cart-total">
        <table class="table" style="width: 50%">
            <tr>
                <th>Image</th>
                <th>Product Title</th>
                <th>Product quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php $totalPrice = 0 ?>

            @foreach($cart as $cart)
                <tr>
                    <td>
                        <img src="/product_images/{{ $cart->image }}" alt="" class="img-thumbnail" style="width: 50%; height: 50%">
                    </td>
                    <td>{{ $cart->product_title }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>Ksh.{{ $cart->price }}</td>
                    <td>
                        <a onclick="return confirm('Are you sure to remove this product from your cart')" href="{{ url('remove_cart',$cart->id) }}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>

                <?php $totalPrice = $totalPrice + $cart->price?>

            @endforeach

        </table>

        <div class="cart-summary">
            <h3 style="font-size: 20px"><strong>Cart Summary</strong></h3>
            <span><strong>Subtotal:</strong> {{ $totalPrice }}</span>
        </div>
    </div>
</div>
<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>
