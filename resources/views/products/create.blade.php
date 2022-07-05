<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">{{ Session::get('user')->fname }}</a>
    <div class="nav-item active">>
        <a href="/dashboard"><button class="btn btn-info" type="submit">Home</button></button></a>
    </div>
    <div class="pull-right">
        <a class="btn btn-danger" href="javascript:history.back()"> Back</a>
    </div>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        </li>
    </ul>
</nav>
@extends('products.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Add New Product</h2>

            </div>

        </div>

    </div>



    @if ($errors->any())
        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif



    <form action="/productstore" method="POST" enctype="multipart/form-data">

        @csrf



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Product Name:</strong>

                    <input type="text" name="name" class="form-control" placeholder="Name">

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Product Description:</strong>

                    <input type="text" name="description" class="form-control" placeholder="Description">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Product Price:</strong>

                    <input type="text" name="price" class="form-control" placeholder="Price">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Product Image:</strong>

                    <input type="file" name="image" class="form-control" placeholder="Photo">

                </div>

            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Post</button>

            </div>

        </div>



    </form>

@endsection
