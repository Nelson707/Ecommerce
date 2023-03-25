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
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->

    <div>
        <h1 style="margin: 10px"><strong>Order Details</strong></h1>

        <table class="table">
            <tr class="bg-info">
                <th class="text-dark">Product Title</th>
                <th class="text-dark">Quantity</th>
                <th class="text-dark">Price</th>
                <th class="text-dark">Payment Status</th>
                <th class="text-dark">Delivery Status</th>
                <th class="text-dark">Image</th>
                <th class="text-dark">Cancel Order</th>
            </tr>

            <?php $totalPrice = 0 ?>

            @foreach($order as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <img src="/product_images/{{ $order->image }}" height="100" width="100">
                    </td>
                    <td>
                        @if($order->delivery_status=='Processing')

                            <a onclick="return confirm('Are you sure you want to cancel the order?')" href="{{ url('cancel_order', $order->id) }}" class="btn btn-danger">Cancel Order</a>

                        @else
                            <p>Not Available</p>

                        @endif
                    </td>
                </tr>

                    <?php $totalPrice = $totalPrice + $order->price?>

            @endforeach
        </table>
        <hr>
        <span style="margin: 10px"><strong>Order sub-total: {{ $totalPrice }}</strong></span>

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
