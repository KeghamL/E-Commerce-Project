<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href={{ asset('product.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"
        integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="userinfo">{{ Session::get('user')->fname }}</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="/productcreate"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add
                        Post</button></a>
            </li>
            <section class="search">
                <form action="/productsearch" method="GET">
                    <div class="form-group">
                        <input type="search" id="search" class="form-control" name="find"
                            placeholder="Search Here...">
                        <div id="searchlist"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary "
                            style="position: absolute; left:280px; bottom:0.5px">Search</button>
                    </div>
                </form>
            </section>
            <li class="nav-item" style="position: absolute; right:30px">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </li>
        </ul>
        </div>
    </nav>


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
    <br>

    <div>
        <div class="row">

            @foreach ($products as $product)
                <div class="col-lg-4 col-sm-6 product-grid">
                    <div class="product-image">
                        <a href="#" class="image">

                            <a href="/productshow/{{ $product->id }}"><img class="pic-1"
                                    src="{{ asset('uploads/products/' . $product->image) }}"></a>
                            <a href="/productshow/{{ $product->id }}"><img class="pic-2"
                                    src="{{ asset('uploads/products/' . $product->image) }}">
                            </a>
                        </a>
                        <ul class="product-links">
                            @if (isset(Session::get('user')->id) && Session::get('user')->id == $product->user_id)
                                <form action="{{ route('product-delete', $product->id) }}" method="POST">
                                    <li><a href=" /productedit/{{ $product->id }}" data-tip="Edit"><i
                                                class="fa fa-cog" aria-hidden="true"></i></a></li>
                                    <li><a href=" /productshow/{{ $product->id }}" data-tip="Show"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a></li>
                                    @csrf
                                    @method('DELETE')
                                    <li><button data-tip="Delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </li>
                                </form>
                            @endif
                        </ul>
                    </div>
                    <div class="product-content">
                        <a href="/productshow/{{ $product->id }}">
                            <h3 class="title">{{ $product->name }}</h3>
                        </a>
                        <a href="/productshow/{{ $product->id }}">
                            <p class="title">{{ $product->description }}</p>
                        </a>
                        <div class="price">{{ $product->price }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="paginate">
        {!! $products->links() !!}
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.3/typeahead.bundle.min.js"
        integrity="sha512-E4rXB8fOORHVM/jZYNCX2rIY+FOvmTsWJ7OKZOG9x/0RmMAGyyzBqZG0OGKMpTyyuXVVoJsKKWYwbm7OU2klxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var path = "{{ route('auto-complete') }}";
        $('#search').typehead({
            source: function(terms, process) {
                return $.get(path, {
                    terms: terms
                }, function(data) {
                    return process(data);
                })
            }
        })
    </script>


    {{-- JQerry + Ajax

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajax({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>

    <script>
        $(documnet).ready(function() {
            $('#search').keyup(function() {
                var value = $(this).val();
                if (value != '') {
                    $.ajax({
                        url: "/productsearchlist",
                        method: "GET",
                        data: {
                            value: value
                        },

                        success: function(data) {
                            $('#searchlist').fadeIn();
                            $('#searchlist').html(data);
                        }
                    });

                } else {
                    $('#searchlist').fadeOut();
                    $('#searchlist').html("");
                }
            });
            $(documnet).on('click', 'li', function() {
                $('#search').val($(this).text());
                $('#searchlist').fadeOut();
            });
        });
    </script> --}}

</body>

</html>
