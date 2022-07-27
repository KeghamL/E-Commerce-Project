<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">{{ auth()->user()->fname }}</a>
    <div class="nav-item active" style="padding-right: 20px">
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

@extends('products.layout')

@section('content')

    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('fail'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Description:</strong>
                {{ $product->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Price:</strong>
                {{ $product->price }}
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Image:</strong>
                <br>
                <img src="{{ asset('uploads/products/' . $product->image) }}"width="300px"height="300px"alt="Image">
            </div> --}}

    </div>
    <form action="/addstar" method="POST">

        {{ csrf_field() }}
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <h3>Add Your Review:</h3>
        <div class="rating">
            <input type="radio" name="star" value="5" id="5"><label for="5">☆</label>
            <input type="radio" name="star" value="4" id="4"><label for="4">☆</label>
            <input type="radio" name="star" value="3" id="3"><label for="3">☆</label>
            <input type="radio" name="star" value="2" id="2"><label for="2">☆</label>
            <input type="radio" name="star" value="1" id="1"><label for="1">☆</label>
        </div>
        <div class="form-group shadow-textarea">
            <label for="exampleFormControlTextarea6"></label>
            <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" name="comment" rows="4"
                placeholder="Write Your Review here..."></textarea>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
    <div class="style">

        @if (count($product->reviews) > 0)
            @foreach ($product->reviews as $review)
                <div class="well">
                    <h3>
                        <small>{{ $review->user->fname }}</small><small>{{ $review->user->lname }}</small>
                        <br>
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $review->stars)
                                <span class="fa fa-star checked"></span>
                            @else
                                <span class="star"></span>
                            @endif
                        @endfor
                    </h3>
                    <h1>{{ $review->comment }}</h1>
                    <form action="{{ route('review-delete', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-tip="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

@endsection





{{-- @foreach ($product->reviews as $review)
        {{ $review->stars }}
        <br>
        {{ $review->comment }}
        <h1>{{ $review->star }} </h1>
    @endforeach --}}
