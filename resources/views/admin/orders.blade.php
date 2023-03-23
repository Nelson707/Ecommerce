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

                <div style="margin: 10px 0">
                    <form action="{{ url('search') }}" method="get">
                        @csrf
                        <input type="text" name="search" placeholder="Search Orders..." style="color: #0a0a0a">
                        <input type="submit" value="Search" class="btn btn-info">
                    </form>
                </div>

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
                            <th class="text-dark">Print PDF</th>
                            <th class="text-dark">Send Email</th>
                        </tr>

                        @forelse($order as $order)
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
                                        <a href="{{ url('delivered', $order->id) }}" onclick="return confirm('Are you sure the product has been delivered?')" class="btn btn-success">Confirm</a>
                                    @else
                                        <p style="color: #00bb00">Confirmed</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-secondary">Print PDF</a>
                                </td>
                                <td>
                                    <a href="{{ url('send_email',$order->id) }}" class="btn btn-info">Send Email</a>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="16">
                                    No Records Found.
                                </td>
                            </tr>

                        @endforelse
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
