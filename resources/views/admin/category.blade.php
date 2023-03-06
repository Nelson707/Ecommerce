<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style href="text/css">
        .div_center{
            text-align: center;
            padding-top: 40px;
        }

        .h2_font{
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color{
            color: #0a0a0a;
        }

        .center {
            width: 50%;
            text-align: center;
            margin: 30px auto auto;
            border: 3px solid white;
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
                    <h2 class="h2_font">Add Category</h2>

                    <form action="{{ url('/add_category') }}" method="post">

                        @csrf

                        <input class="input_color" type="text" name="category" placeholder="Category Name">

                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                    </form>
                </div>

                <table class="center">
                    <tr>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>

                    @foreach($data as $data)

                    <tr>
                        <td>{{$data->category_name}}</td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete the category?')" href="{{ url('delete_category',$data->id) }}" class="btn btn-danger">Delete</a>
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
