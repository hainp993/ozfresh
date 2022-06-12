@extends('layouts.app')

@section('content')
<main id="site-container" class="site-main">
   <div class="container">
      <div id="container">
         <div id="content" role="main">
            <div class="woocommerce-notices-wrapper"></div>
            <div id="product-1171" class="product type-product post-1171 status-publish first instock product_cat-nuoc-hoa product_cat-nuoc-hoa-nam product_cat-nuoc-hoa-mini-versace product_cat-nuoc-hoa-mini product_cat-nuoc-hoa-doanh-nhan product_cat-brands product_cat-nuoc-hoa-nam-versace product_cat-versace has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
               <div class="single-product-title-wrapper">
                  <h1 id="product-title" class="product_title entry-title">{{$product->name}}</h1>
                  <div class="woocommerce-product-rating">
                     <div class="star-rating" role="img" aria-label="Được xếp hạng {{$product->rate}} 5 sao">
                        <span style="width:88.6%"><strong class="rating">đánh giá {{$product->rate}} sao</span>
                     </div>
                     <a href="#reviews" class="woocommerce-review-link scroll-btn" rel="nofollow">(Đã bán {{$product->sell_number}} sách)</a>
                  </div>
               </div>
               <div data-sticky-container="">
                  <div class="row">
                     <div class="col-md-4" style="overflow: hidden;">
                        <span class="ping ping-repay">Trả sau 0%</span>
                        <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-5 images" data-columns="5" style="opacity: 1;">
                           <div class="product-thumb-wrap" style="width: 100%; float: left;">
                              <div data-thumb="" class="woocommerce-product-gallery__image"><a href="#" class="show-product-gallery-fotorama" data-index="0">
                                 <img class="product-image wp-post-image" width="275" height="275" src="{{$product->thumbnail}}" alt="Versace-Pour-Homme_1.jpg"></a></div>
                           </div>
                        </div>
                        <div id="product-gallery-fotorama" data-thumb-count="2" data-real-count="1" data-nav="thumbs" class="fotorama hidden" data-allowfullscreen="true" data-auto="false">
                        </div>
                        <div class="shopee-link-button hidden"><a class="shopee-link" href="https://shopee.vn/.vn_officialstore" target="_blank" rel="noopener noreferrer nofollow">Giá rẻ hơn tại</a></div>
                     </div>
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="product-left">
                                 <div id="custom_html-13" class="widget_text widget widget_custom_html">
                                    <div class="textwidget custom-html-widget">
                                       <div class="area_promotion">
                                          <strong>Khuyến mãi &amp; Chương trình</strong>
                                          <div class="infopr">
                                             <!--<span>Nhập mã: <b class="text-color-">XACTHUC</b> giảm 8% tối đa 100k <i style="font-size: 90%;">(áp dụng tài khoản đã xác thực online, xác thực OTP <a href="https://.vn/tai-khoan/" style=" display: inline-block; ">tại đây</a></i></span>--><span>Nhập mã: <b class="text-color-">FREE20KSHIP</b> giảm 20k phí ship (HĐ từ 500k)</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="area_order">
                                    <a id="mua-ngay" class="buy_now buy_repay" href="/add-cart?id={{$product->id}}"><b>MUA NGAY</b><span>Giao hàng tận nơi hoặc tại cửa hàng</span></a>
                                    <a data-product-id="1171" data-variation-id="1175" data-quantity="1" href="/add-cart?id={{$product->id}}" class="btn buy_repay"><b><i class="icon-icon-add-to-cart"></i> THÊM VÀO GIỎ</b><span></span></a>
                                    <div class="text-center">Gọi đặt mua: <a onclick="goog_report_conversion('tel:0378678272')" href="tel:0378678272">0378678272</a></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div id="product-variation-right-box" class="product-variation-right-box" data-sticky="" data-sticky-class="is-sticky" data-margin-top="10">
                                 <div id="custom_html-6" class="widget_text widget widget_custom_html">
                                    <div class="textwidget custom-html-widget">
                                       <ul id="hotrodonhang">
                                          <li><i class="icon-icon-verified"></i><b>Cam kết hàng chính hãng 100%</b> <br>Hoàn tiền <b>200%</b> nếu phát hiện hàng giả</li>
                                          <li><i class="icon-icon-guaruntee"></i><b>Bảo hành đến giọt cuối cùng</b> <br>Đổi trả trong <b>30 ngày</b> <a target="_blank" href="https://.vn/cam-ket-bao-hanh-doi-tra/" rel="noopener">(click xem chi tiết)</a></li>
                                          <li><i class="icon-icon-ship24h"></i> <b>Giao hàng 24h</b></li>
                                          <li><i class="icon-icon-freeship"></i> <b>Miễn phí ship nội thành HĐ từ 700K</b></li>
                                          <li><i class="icon-icon-gift"></i> <b>Miễn phí gói quà</b></li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="social-button">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-8">
                        <div class="woocommerce-tabs wc-tabs-wrapper">
                           <ul class="tabs wc-tabs">
                              <li class="description_tab active">
                                 <a href="#tab-description">Mô tả</a>
                              </li>
                              
                           </ul>
                           <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" style="display: block;">
                              <div style="padding-top:20px; padding-bottom: 20px;">
                                 {{$product->description}}
                              </div>
                           </div>
                        </div>
                        <!-- reviews-vote area -->
                        <div class="entry-content" id="tab-reviews">
                           <div id="reviews" class="woocommerce-Reviews" data-product_id="1171">
                              <div id="comments">
                                 <h2 class="woocommerce-Reviews-title">
                                    Bình luận
                                 </h2>
                                 <div class="commentlist-box">
                                 <div class="fb-comments" data-href="http://localhost:8000/product/{{$product->slug}}" data-width="" data-numposts="5"></div>
                                 </div>
                              </div>
                              <div class="clear"></div>
                           </div>
                           <div class="devvn_prod_cmt">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4"></div>
                  </div>
               </div>
            </div>
            <h3 class="related-title widget-title text-center mt-4">Các sách khác</h3>
            <div class="related related-products woocommerce columns-6 owl-template">
               <div class="products js-six-nav-noauto">
                  @foreach($productNews as $product)
                     <div class="product-item col-md-2 col-sm-4 col-xs-6 instock ">
                        <a data-id="90524" data-name="Armaf Club De Nuit Intense For Man" data-category="Nước Hoa/Nước Hoa Nam/Armaf" href="/product/{{$product->slug}}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" onclick="goog_product_list_click(this)">
                           <div class="product-sale-flash-thumb-wrap">
                              <div class="product-thumb-wrap">
                                 <img class="lazy lazyloaded" width="165" src="{{$product->thumbnail}}" data-src="{{$product->thumbnail}}" alt="">
                              </div>
                           </div>
                           <h2 class="woocommerce-loop-product__title">{{$product->title}}</h2>
                           <span class="price">{{number_format($product->price)}} <span class="currency">₫</span></span>
                        </a>
                        <div class="woocommerce-product-rating">
                           <a data-id="90524" data-name="Armaf Club De Nuit Intense For Man" data-category="Nước Hoa/Nước Hoa Nam/Armaf" href="/product/{{$product->slug}}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" onclick="goog_product_list_click(this)">
                              <div class="star-rating" role="img" aria-label="Được xếp hạng 5.00 5 sao"><span style="width:{{20 * $product->rate}} %"><strong class="rating">{{$product->rate}}</strong> trên 5 dựa trên <span class="rating">8</span> đánh giá</span></div>
                           </a>
                           <a href="#reviews" class="woocommerce-review-link scroll-btn" rel="nofollow">(Đã bán {{$product->sell_number}})</a>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=543121906576699&autoLogAppEvents=1" nonce="FcUR4gRg"></script>@endsection
