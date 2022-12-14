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

<br>
@extends('products.layout')

@section('content')
    <div>
        <div class="row">

            @foreach ($products as $product)
                <div class="col-lg-4 col-sm-6 product-grid">
                    <div class="product-image">
                        <a href="#" class="image">

                            <a href="/productshow/{{ $product->id }}"><img class="pic-1"
                                    src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YXBwbGUlMjBsYXB0b3B8ZW58MHx8MHx8&w=1000&q=80"></a>
                            <a href="/productshow/{{ $product->id }}"><img class="pic-2"
                                    src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YXBwbGUlMjBsYXB0b3B8ZW58MHx8MHx8&w=1000&q=80">
                            </a>
                        </a>
                        <ul class="product-links">
                            @if (isset(auth()->user()->id) && auth()->user()->id == $product->user_id)
                                <form action="{{ route('product-delete', $product->id) }}" method="POST">
                                    <li><a href=" /productedit/{{ $product->id }}" data-tip="Edit"><i class="fa fa-cog"
                                                aria-hidden="true"></i></a></li>
                                    <li><a href=" /productshow/{{ $product->id }}" data-tip="Show"><i class="fa fa-eye"
                                                aria-hidden="true"></i></a></li>
                                    @csrf
                                    @method('DELETE')
                                    <li><button data-tip="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </li>
                                </form>
                            @endif
                        </ul>
                    </div>
                    <div class="product-content">
                        <h3 class="title">{{ $product->name }}</h3>
                        <p class="title">{{ $product->description }}</p>
                        <div class="price">{{ $product->price }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
