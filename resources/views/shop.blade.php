@extends('layouts.app')

@section('content')
<main id="site-container" class="site-main" role="main">
    <div class="breadcrumb-archive">
        <div class="container">
            <nav class="woocommerce-breadcrumb" style="padding: 20px 0"><a href="/">Home</a>
            @if($category)
            <i class="glyphicon glyphicon-menu-right"></i>
            <a href="/search?category={{$category->slug}}">{{$category->name}}</a>
            @endif
            <i class="glyphicon glyphicon-menu-right"></i>Có {{$total}} sách</nav>
        </div>
    </div>
    <div class="container">
        <div class="filter">
            @if($searchKey)
            <h1 class="page-title archive-title text-right">Kết quả tìm kiếm cho "{{$searchKey}}"</h1>
            @endif
            <div class="clearfix"></div>
        </div>
        <div id="content">
            <div class="products row ">
                @if($total == 0)
                    <p class="text-center" style="color:#0077b3; font-size: 16px; font-weight: bold">Không có sách nào</p>
                @endif
                @foreach($posts as $product)
                <div class="product-item col-md-2 col-xs-6 instock ">
                    <a data-id="220442" data-name="Paco Rabanne Phantom For Men" data-category="Nước Hoa/Nước Hoa Nam/Paco Rabanne" href="/product/{{$product->slug}}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" onclick="goog_product_list_click(this)">
                        <div class="product-sale-flash-thumb-wrap">
                            <div class="product-thumb-wrap">
                                <img class="lazy lazyload" width="165" src="{{$product->thumbnail}}" data-src="{{$product->thumbnail}}" alt="">
                            </div>
                        </div>
                        <h2 class="woocommerce-loop-product__title">{{$product->name}}</h2>
                        <div class="title-price-box row">
                            <div class="col-sm-7 col-xs-12"><span class="price">{{number_format($product->price)}} <span class="currency">₫</span></span></div>
                            <div class="col-sm-5 col-xs-12">
                                <a href="/add-cart?id={{$product->id}}" class="product-btn-link btn  product-atc-btn">
                                    <i class="glyphicon glyphicon-plus"></i> Thêm vào giỏ
                                </a>
                            </div>
                        </div>
                        <div class="woocommerce-product-rating">
                            <div class="star-rating" role="img" aria-label="Được xếp hạng 5.00 5 sao">
                                <span style="width:{{20 * $product->rate}}%"><strong class="rating">5.00</strong> trên 5 dựa trên <span class="rating">1</span>
                                    đánh giá</span>
                            </div>
                            <a href="#reviews" class="woocommerce-review-link scroll-btn" rel="nofollow">(Đã bán {{$product->sell_number}})</a>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <nav class="woocommerce-pagination">
                <div class="loadmore-row">
                    {{$posts->links('pagination.default')}}
                </div>
            </nav>
        </div>
    </div>
</main>
@endsection