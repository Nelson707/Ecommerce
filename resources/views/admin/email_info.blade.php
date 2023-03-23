<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="/public">
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

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                    </div>
                @endif

                <h1 style="text-align: center; font-size: 25px">Send Email to: {{ $order->email }}</h1>

                <form action="{{ url('send_user_email', $order->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email Greeting</label>
                        <input type="text" name="greeting" class="form-control" style="color: #000">
                    </div>

                    <div class="form-group">
                        <label>Email First Line</label>
                        <input type="text" name="firstline" class="form-control" style="color: #000">
                    </div>

                    <div class="form-group">
                        <label>Email Body</label>
                        <textarea  class="form-control" name="body" id="" cols="30" rows="10" style="color: #000"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Email Button Name</label>
                        <input type="text" name="button" class="form-control" style="color: #000">
                    </div>

                    <div class="form-group">
                        <label>Email Url</label>
                        <input type="text" name="url" class="form-control" style="color: #000">
                    </div>

                    <div class="form-group">
                        <label>Email Last Line</label>
                        <input type="text" name="lastline" class="form-control" style="color: #000">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Send Email" class="btn btn-primary" class="form-control">
                    </div>

                </form>
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
