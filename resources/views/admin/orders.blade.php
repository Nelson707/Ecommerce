<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
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

                <h1 class="text-center font-weight-bold text-uppercase">All Orders</h1>

                <div class="table-responsive">
                    <table class="table">
                        <tr class="bg-info">
                            <th class="text-dark">Name</th>
                            <th class="text-dark">Email</th>
                            <th class="text-dark">Address</th>
                            <th class="text-dark">Phone</th>
                            <th class="text-dark">Product Title</th>
                            <th class="text-dark">Quantity</th>
                            <th class="text-dark">Price</th>
                            <th class="text-dark">Payment Status</th>
                            <th class="text-dark">Delivery status</th>
                            <th class="text-dark">Image</th>
                            <th class="text-dark">Delivery confirmation</th>
                        </tr>

                        @foreach($order as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td>
                                    <img src="/product_images/{{ $order->image }}">

                                </td>
                                <td>
                                    @if($order->delivery_status=='Processing')
                                        <a href="{{ url('delivered', $order->id) }}" onclick="return confirm('Are you sure the product has been delivered?')" class="btn btn-primary">Delivered</a>
                                    @else
                                        <p style="color: #00bb00">Delivered</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
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
