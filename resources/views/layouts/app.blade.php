<!DOCTYPE html>
<html lang="vi-VN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

   <title> Cửa hàng sách</title>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="description" content=" Chuyên Phân Phối Nước Hoa, Mỹ Phẩm Toàn Thế Giới Hàng Nhập Khẩu Chính Hãng Giá Tốt Bảo Hành Giọt Cuối Cùng Uy Tín Từ 2004" />
   <link rel='preload' as='style' onload='this.rel = "stylesheet"' id='fonts-css' href='/client/wp-content/cache/autoptimize/css/autoptimize_single_a820779498d5c5f528b4208eec5ee1be0ab4.css?ver=3f1bc1fc09f3fc773de26c2858f0f9cce1560fcf' type='text/css' media='all' />
   <link rel="icon" href="/client/wp-content/uploads/2019/12/favicon.png" sizes="32x32" />
   <link rel="icon" href="/client/wp-content/uploads/2019/12/favicon.png" sizes="192x192" />
   <link rel="apple-touch-icon" href="/client/wp-content/uploads/2019/12/favicon.png" />
   <link rel="stylesheet" href="/client/client.css">
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
   <style>
      #menu-menu-chinh li.active a {
         color: red !important;
      }
   </style>
</head>

<?php

$categories = App\Models\ProductCategory::orderBy('id')->limit(8)->get();

?>

<body class="home page-template page-template-no-title page-template-no-title-php page page-id-83604 wp-custom-logo theme- siteorigin-panels siteorigin-panels-before-js siteorigin-panels-home woocommerce-no-js">
   <div id="wrapper">
      <header id="site-header">
         <div id="site-top">
            <div class="slogan">.</div>
            <div id="site-mobile-menu" class="header-ctn container">
               <div class="pull-left visible-sm visible-xs">
                  <a href="javascript:void(0)" class="cd-btn menu">
                     <span class="menu-line"></span>
                     <span class="menu-line"></span>
                     <span class="menu-line"></span>
                  </a>
               </div>
               <div class="pull-left logo-top">
                  <a href="/" class="custom-logo-link" rel="home"><img width="515" height="100" src="/client/wp-content/uploads/2020/01/logo-gentleman.png" class="custom-logo" alt="" loading="lazy" data-no-lazy="1" srcset="https://.vn/wp-content/uploads/2020/01/logo-.png 515w, https://.vn/wp-content/uploads/2020/01/logo--300x58.png 300w, https://.vn/wp-content/uploads/2020/01/logo--414x80.png 414w" sizes="(max-width: 515px) 100vw, 515px" /></a>
               </div>
               <div class="pull-right">
                  <a class="add_to_cart_icon" href="/cart"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="cart-contents-text">Giỏ hàng</span> <span class="cart-contents-number hidden">0</span></a>
               </div>
               <div class="pull-right">
                  <div id="account-drop" class="dropdown" style="z-index: 9999;">
                     <a href="/login" class="dropdown-toggle" id="accountDropdownMenu" aria-haspopup="true" aria-expanded="true">
                        @if (!Auth::check())
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="account-text">Đăng nhập</span>
                        @endif
                     </a>
                     @if (Auth::check())
                     <form method="post" action="/logout">
                        @csrf
                        <span class="glyphicon glyphicon-user"></span>
                        <button class="account-text" style="border:none; background:none">Đăng xuất</button>
                     </form>
                     @endif
                     <ul class="dropdown-menu pull-right" aria-labelledby="accountDropdownMenu">
                     </ul>
                  </div>
               </div>
               <div class="pull-right">
                  <a id="searchDropdownMenu" href="javascript:;">
                     <span class="glyphicon glyphicon-search"></span>
                  </a>
               </div>
            </div>
         </div>
         <div class="modal fade order-tracking-modal" id="order_tracking_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Kiểm tra đơn hàng</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="woocommerce">
                        <form action="#" method="post" class="track_order">
                           <p>Để theo dõi đơn hàng của bạn xin vui lòng nhập ID đơn hàng của bạn vào ô dưới đây và nhấn nút "Theo dõi". ID đơn hàng đã được gửi cho bạn qua biên lai và qua email xác nhận mà bạn nhận được.</p>
                           <p class="form-row form-row-first"><label for="orderid">Mã đơn hàng <small style="font-style: italic;">(Ví dụ: 59TD/14xx, WOO/183xxx, S054xx)</small></label> <input required class="input-text" type="text" name="orderid" id="orderid" placeholder="Tìm thấy trong hoá đơn hoặc email xác nhận đặt hang" /></p>
                           <p class="form-row form-row-last"><label for="order_phone">Số điện thoại</label> <input required class="input-text" type="tel" name="order_phone" id="order_phone" placeholder="Số điện thoại sử dụng trong quá trình thanh toán." /></p>
                           <div class="clear"></div>
                           <p class="form-row"><input type="submit" class="button btn btn-success" name="track" value="Theo dõi" /></p>
                           <input type="hidden" id="_wpnonce" name="_wpnonce" value="f533e86755" /><input type="hidden" name="_wp_http_referer" value="/" />
                        </form>
                        <div class="order-tracking-result fade"></div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                  </div>
               </div>
            </div>
         </div>
         <div id="site-logo">
            <a href="/" class="custom-logo-link" rel="home">
               <img src="/images/logo.png" alt="" width="100px">
            </a>
            <div class="container" style="position: relative;">
               <div class="search-form search-form-desktop">
                  <form class="search-form-js" action="/search">
                     <div class="input-group">
                        <button type="submit">
                           <i class="glyphicon glyphicon-search" aria-hidden="true"></i>
                        </button>
                        <input class="search-field" name="q" value="" type="text" placeholder="Tìm sách, thương hiệu, ...">
                        <div class="search-autocomplete">
                           <div id="custom_html-16" class="widget_text widget widget_custom_html">
                              <div class="textwidget custom-html-widget">
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="search-bg"></div>
      </header>
      <nav id="navigation" role="navigation">
         <div class="container">
            <div class="inner">
               <div class="sticky-logo pull-left">
                  <!-- <a href="/" class="custom-logo-link" rel="home"><img width="515" height="100" src="/client/wp-content/uploads/2020/01/logo1.png" class="custom-logo" alt="" loading="lazy" data-no-lazy="1" srcset="https://.vn/wp-content/uploads/2020/01/logo-.png 515w, https://.vn/wp-content/uploads/2020/01/logo--300x58.png 300w, https://.vn/wp-content/uploads/2020/01/logo--414x80.png 414w" sizes="(max-width: 515px) 100vw, 515px" /></a> -->
               </div>
               <div id="primary-menu" class="menu pull-left">
                  <ul id="menu-menu-chinh" class="menu">
                     @foreach($categories as $category)
                     <li id="menu-item-119400" class="menu-col-2 menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-119400">
                        <a id="slug-{{$category->slug}}" href="/search?category={{$category->slug}}">{{$category->name}}</a>
                     </li>
                     @endforeach
                     <li id="menu-item-9203" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9203"><a href="/blog">Blog</a></li>
                  </ul>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </nav>

      @yield('content')

      
   <div class="popup-added-to-cart-bg popup-added-to-cart-close"></div>
   <div class="popup-added-to-cart woocommerce">
      <div class="alert-added-to-cart">
         <p class="text-message"><i class="glyphicon glyphicon-ok"></i><span class="text"> Đã thêm vào giỏ hàng</span></p>
         <div class="media">
            <div class="media-image"><img class="lazyload" width="96" height="96" width="96" src="data:image/svg+xml,%3Csvg%20xmlns=%22https://www.w3.org/2000/svg%22%20viewBox=%220%200%2096%2096%22%3E%3C/svg%3E" data-src="https://.vn/wp-content/uploads/2017/08/_logo_original-165x165.png" alt=""></div>
            <div class="media-content">
               <p class="title"></p>
               <div><small></small></div>
               <div class="quantity">
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus glyphicon glyphicon-minus"></button>
                  <input class="qty" min="0" name="quantity" value="1" type="number">
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus glyphicon glyphicon-plus"></button>
               </div>
               <div><small><span>Thương hiệu: </span><a class="brand" href="javascript:void(0)"></a></small></div>
               <div><small><span>Barcode: </span><a class="sku" href="javascript:void(0)"></a></small></div>
            </div>
         </div>
         <button class="btn btn-close popup-added-to-cart-close">close</button>
         <a class="button btn-cart" href="gio-hang/index.html">
            Xem giỏ hàng &amp; thanh toán
         </a>
         <button tabindex="0" class="button neutral expanded btn-close popup-added-to-cart-close" type="button"><span class="c160">Tiếp tục mua sắm</span><span class="c76"></span></button>
      </div>
   </div>
   <div id="fb-root"></div>
   <script defer async="async" src="/client/wp-content/cache/autoptimize/js/autoptimize_62724d986dbcc670242aded731f14445.js"></script>
</body>

</html>


<script>
   function getParameterByName(name, url = window.location.href) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
         results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
   }

   var slug = getParameterByName('category');
   if (slug) {
      console.log(slug, 'slug');
      const menuItem = document.querySelector(
         `#slug-${slug}`
      );
      menuItem?.parentElement.classList.add("active");
   }
</script>
