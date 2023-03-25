<section class="product_section layout_padding">
    <div class="container">

        <div class="row">

            @foreach($product as $products)

                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details',$products->id) }}" class="option1">
                                    View Item
                                </a>

                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product_images/{{ $products->image }}" alt="">
                        </div>
                        <div class="detail-box" style="display: block">
                            <h5>
                                {{ $products->title }}
                            </h5>

                            @if($products->discount_price!=null)

                                <h6 style="color: red">
                                    Ksh.{{ $products->discount_price }}
                                </h6>

                                <h6 style="text-decoration: line-through">
                                    Ksh.{{ $products->price }}
                                </h6>

                            @else

                                <h6 style="color: dodgerblue">
                                    Ksh.{{ $products->price }}
                                </h6>

                            @endif

                        </div>
                    </div>
                </div>

            @endforeach

            <span style="padding-top: 20px">
                {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
            </span>

        </div>

        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>
</section>
