@extends('layouts.app')

@section('content')

@if(!Session::get('cart'))


<main id="site-container" class="site-main" role="main">
    <div class="container">
        <div id="page-9140" class="post-9140 page type-page status-publish hentry">
            <div class="page-content">
                <div id="pl-9140" class="panel-layout">
                    <div id="pg-9140-1" class="panel-grid panel-has-style">
                        <div class="cart-checkout-row siteorigin-panels-stretch panel-row-style panel-row-style-for-9140-1" data-stretch-type="full" style="margin-left: -312px; margin-right: -312px; padding-left: 312px; padding-right: 312px; border-left: 0px; border-right: 0px;">
                            <div id="pgc-9140-1-0" class="panel-grid-cell">
                                <div id="panel-9140-1-0-0" class="so-panel widget widget_sow-editor panel-first-child" data-index="1">
                                    <div class="cart-row panel-widget-style panel-widget-style-for-9140-1-0-0">
                                        <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                            <div class="siteorigin-widget-tinymce textwidget">
                                                <div class="woocommerce">
                                                    <style>
                                                        .empty-cart-cls .glyphicon.glyphicon-shopping-cart:after {
                                                            content: '0';
                                                            background-color: #d71921;
                                                            width: 18px;
                                                            height: 18px;
                                                            position: absolute;
                                                            left: 15px;
                                                            top: 22px;
                                                            line-height: 18px;
                                                            font-size: 16px;
                                                            text-align: center;
                                                            border-radius: 50%;
                                                            font-family: arial;
                                                        }
                                                    </style>
                                                    <div class="container-fluid mt-100">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body cart">
                                                                        <div class="col-sm-12 empty-cart-cls text-center" style=" padding: 5% 0; ">
                                                                            <span class="glyphicon glyphicon-shopping-cart" style=" background-color: #333; color: #fff; width: 80px; height: 80px; font-size: 29px; line-height: 78px; border-radius: 50%; "></span>
                                                                            <h3><strong>Không có sách nào trong giỏ hàng</strong></h3>
                                                                            <a href="/"class="btn btn-primary cart-btn-transform m-3" data-abc="true" style=" background-color: #333; margin-top: 10px; border: none; ">Quay trở lại cửa hàng</a>
                                                                            <h5 style="margin-top: 15px;">Khi cần trợ giúp vui lòng gọi <a href="tel:18006122">1800.6122</a> hoặc <a href="tel:02873051122">028.7305.1122</a> (7h30 - 22h)</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-9140-1-0-1" class="so-panel widget widget_sow-editor" data-index="2">
                                    <div class="checkout-row panel-widget-style panel-widget-style-for-9140-1-0-1">
                                        <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                            <div class="siteorigin-widget-tinymce textwidget">
                                                <div class="woocommerce">
                                                    <div class="woocommerce-notices-wrapper"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-9140-1-0-2" class="widget_text so-panel widget widget_custom_html panel-last-child" data-index="3">
                                    <div class="textwidget custom-html-widget">
                                        <style>
                                            .woocommerce-account-fields input#createaccount+span {
                                                padding-left: 23px;
                                            }

                                            .woocommerce-account-fields input#createaccount {
                                                top: 4px;
                                            }

                                            .checkout .wc_coupon_message_wrap {
                                                padding: 0 !important;
                                            }

                                            .panel-grid.panel-has-style>.panel-row-style.cart-promotion {
                                                display: none;
                                            }

                                            body.cart-above-1500 .panel-grid.panel-has-style>.panel-row-style.cart-promotion {
                                                display: flex;
                                            }

                                            body.woocommerce-checkout #site-footer {
                                                margin-top: 0;
                                            }

                                            .checkout-login-reminder {
                                                padding: 10px 0;
                                            }

                                            .woocommerce form.login input.button {
                                                color: #fff;
                                                background-color: #d51e28;
                                                margin-right: 10px;
                                            }

                                            #coupons_list {
                                                padding: 0;
                                            }

                                            #coupons_list #all_coupon_container {
                                                padding: 15px 10px;
                                            }

                                            #coupons_list #all_coupon_container {
                                                padding: 15px 10px;
                                            }

                                            .nsl-container.nsl-container-block {
                                                display: inline-block;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@else
<?php
$cart = Session::get('cart');
$total = 0;
$countProduct = 0;
if ($cart) {
    foreach ($cart as $item) {
        $total += $item->so_luong_mua * $item->price;
        $countProduct++;
    }
}
?>
<main id="site-container" class="site-main" role="main">
    <div class="container">
        <div id="page-9140" class="post-9140 page type-page status-publish hentry">
            <div class="page-content">
                <div id="pl-9140" class="panel-layout">
                    <div id="pg-9140-1" class="panel-grid panel-has-style">
                        <div class="cart-checkout-row siteorigin-panels-stretch panel-row-style panel-row-style-for-9140-1" data-stretch-type="full">
                            <div id="pgc-9140-1-0" class="panel-grid-cell">
                                <div id="panel-9140-1-0-0" class="so-panel widget widget_sow-editor panel-first-child" data-index="1">
                                    <div class="cart-row panel-widget-style panel-widget-style-for-9140-1-0-0">
                                        <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                            <div class="siteorigin-widget-tinymce textwidget">
                                                <div class="woocommerce">
                                                    <div class="woocommerce-notices-wrapper"></div>
                                                    <form class="woocommerce-cart-form" action="https://.vn/gio-hang/" method="post">
                                                        <h3 id="add-to-cart-heading">Giỏ hàng</h3>
                                                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="product-remove">&nbsp;</th>
                                                                    <th class="product-thumbnail">&nbsp;</th>
                                                                    <th class="product-name">sách</th>
                                                                    <th class="product-price">Giá</th>
                                                                    <th class="product-quantity">Số lượng</th>
                                                                    <th class="product-subtotal">Tổng cộng</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach(Session::get('cart') as $product)
                                                                <tr class="woocommerce-cart-form__cart-item cart_item">
                                                                    <td class="product-remove">
                                                                        <a href="cart/remove-item?id={{$product->id}}" class="remove" aria-label="Xóa sách này" data-product_id="1171" data-product_sku="8011003996032">&times;</a>
                                                                    </td>
                                                                    <td class="product-thumbnail">
                                                                        <a target="_blank" href="/product/">
                                                                            <img width="165" height="165" data-srcset="{{$product->thumbnail}}" src="{{$product->thumbnail}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazyload" alt="" loading="lazy" sizes="(max-width: 165px) 100vw, 165px" width="165" />
                                                                        </a>
                                                                    </td>
                                                                    <td class="product-name" data-title="sách">
                                                                        <a target="_blank" href="/product/{{$product->slug}}">{{$product->name}}</a>
                                                                    </td>
                                                                    <td class="product-price" data-title="Giá">
                                                                        <span class="woocommerce-Price-amount amount"><bdi>{{number_format($product->price)}}&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                                    </td>
                                                                    <td class="product-quantity" data-title="Số lượng">
                                                                        <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus glyphicon glyphicon-minus"></button>							 -->
                                                                        <div class="quantity">
                                                                            <input type="number" step="1" min="0" disabled="disabled" value="1" title="SL" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" />
                                                                        </div>
                                                                        <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus glyphicon glyphicon-plus"></button> -->
                                                                    </td>
                                                                    <td class="product-subtotal" data-title="Tổng cộng">
                                                                        <span class="woocommerce-Price-amount amount"><bdi>
                                                                                {{number_format($product->price)}}
                                                                                &nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-9140-1-0-1" class="so-panel widget widget_sow-editor" data-index="2">
                                    <div class="checkout-row panel-widget-style panel-widget-style-for-9140-1-0-1">
                                        <div class="so-widget-sow-editor so-widget-sow-editor-base">
                                            <div class="siteorigin-widget-tinymce textwidget">
                                                <div class="woocommerce">
                                                    <div class="woocommerce-notices-wrapper"></div>
                                                    <div class="woocommerce-notices-wrapper"></div>
                                                    <form method="POST" action="/cart/checkout">
                                                         @csrf
                                                        <div class="wc_coupon_message_wrap" style="padding: 10px 0 10px;">
                                                            <div class="no_wc_coupon_message"></div>
                                                        </div>
                                                        <div class="col2-set" id="customer_details">
                                                            <div class="col-1">
                                                                <div class="woocommerce-billing-fields">
                                                                    <h3 id="billing-heading">Thanh toán và giao hàng</h3>
                                                                    @if ($errors->any())
                                                                    @foreach ($errors->all() as $error)
                                                                    <div style="color:red">{{$error}}</div>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="woocommerce-billing-fields__field-wrapper clearfix">
                                                                        <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="5">
                                                                            <label for="billing_last_name" class="">Tên&nbsp; <abbr class="required" title="bắt buộc">*</abbr>
                                                                            </label>
                                                                            <span class="woocommerce-input-wrapper">
                                                                                <input type="text" class="input-text" name="hoten" id="billing_last_name" placeholder="Họ và tên" value="" autocomplete="family-name" />
                                                                            </span>
                                                                        </p>
                                                                        <p class="form-row form-row-wide validate-email" id="billing_email_field" data-priority="10">
                                                                            <label for="billing_email" class="">Địa chỉ email&nbsp; <span class="optional">(tuỳ chọn)</span>
                                                                            </label>
                                                                            <span class="woocommerce-input-wrapper">
                                                                                <input type="email" class="input-text" name="email" id="billing_email" placeholder="Email" value="" autocomplete="email username" />
                                                                            </span>
                                                                        </p>
                                                                        <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="30">
                                                                            <label for="billing_phone" class="">Số điện thoại&nbsp; <abbr class="required" title="bắt buộc">*</abbr>
                                                                            </label>
                                                                            <span class="woocommerce-input-wrapper">
                                                                                <input type="tel" class="input-text" name="phone" id="billing_phone" placeholder="Số điện thoại" value="" autocomplete="tel" />
                                                                            </span>
                                                                        </p>
                                                                        <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="1000">
                                                                            <label for="billing_address_1" class="">Địa chỉ&nbsp; <abbr class="required" title="bắt buộc">*</abbr>
                                                                            </label>
                                                                            <span class="woocommerce-input-wrapper">
                                                                                <input type="text" class="input-text" name="diachi" id="billing_address_1" placeholder="Số nhà/tên đường" value="" autocomplete="address-line1" />
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                                <tfoot>
                                                                    <tr class="cart-subtotal">
                                                                        <th>Tổng cộng</th>
                                                                        <td></td>
                                                                        <td><span class="woocommerce-Price-amount amount"><bdi>{{$total}}&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></td>
                                                                    </tr>
                                                                    <tr class="shipping">
                                                                        <th>Shipping</th>
                                                                        <td></td>
                                                                        <td data-title="Shipping">
                                                                            <p>Miễn phí.</p>
                                                                            <form class="woocommerce-shipping-calculator" action="https://.vn/gio-hang/" method="post">
                                                                                <p><a href="#" class="shipping-calculator-button">Calculate Shipping</a></p>
                                                                                <section class="shipping-calculator-form" style="display:none;">
                                                                                    <p class="form-row form-row-wide" id="calc_shipping_country_field">
                                                                                        <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
                                                                                            <option value="">Chọn quốc gia&hellip;</option>
                                                                                            <option value="VN" selected='selected'>Việt Nam</option>
                                                                                        </select>
                                                                                    </p>
                                                                                    <p class="form-row form-row-wide" id="calc_shipping_state_field">
                                                                                        <input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="State / county" />
                                                                                    </p>
                                                                                    <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
                                                                                        <input type="text" class="input-text" value="" placeholder="Mã bưu điện" name="calc_shipping_postcode" id="calc_shipping_postcode" />
                                                                                    </p>
                                                                                    <p><button type="submit" name="calc_shipping" value="1" class="button">Update Totals</button></p>
                                                                                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="51c8b01618" /><input type="hidden" name="_wp_http_referer" value="/gio-hang/" />
                                                                                </section>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="order-total">
                                                                        <th>Tổng cộng</th>
                                                                        <td></td>
                                                                        <td><strong><span class="woocommerce-Price-amount amount"><bdi>{{number_format($total)}}&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></strong> </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <div id="payment" class="woocommerce-checkout-payment">
                                                                <ul class="wc_payment_methods payment_methods methods">
                                                                    <li class="wc_payment_method payment_method_cod">
                                                                        <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked='checked' data-order_button_text="" />
                                                                        <label for="payment_method_cod">
                                                                            Trả tiền mặt khi nhận hàng </label>
                                                                    </li>
                                                                    <li class="wc_payment_method payment_method_cod">
                                                                        <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked='checked' data-order_button_text="" />
                                                                        <label for="payment_method_cod">
                                                                            Thanh toán tại quầy </label>
                                                                    </li>
                                                                    <li class="wc_payment_method payment_method_cod">
                                                                        <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="vnpay"  data-order_button_text="" />
                                                                        <label for="payment_method_cod">
                                                                            Thanh toán VNPAY </label>
                                                                    </li>
                                                                </ul>
                                                                <div class="form-row place-order">
                                                                    <noscript>
                                                                        Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so. <br /><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Cập nhật tổng" />
                                                                    </noscript>
                                                                    <p class="automatewoo-optin form-row">
                                                                    </p>
                                                                    <p class="checkout-note-points">Nếu bạn không hài lòng với sách của chúng tôi? Bạn hoàn toàn có thể đổi trả lại sách trong 30 ngày. Tìm hiểu thêm .</p>
                                                                    <div class="pay-order-box">
                                                                        <input type="submit" class="button alt" id="place_order" value="Đặt hàng" data-value="Đặt hàng" />
                                                                        <span class="pay-order-note">
                                                                            Ship tới không mua không sao. Mua rồi vẫn đổi trả miễn phí.</span>
                                                                    </div>

                                                                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="d27527c7d2" /><input type="hidden" name="_wp_http_referer" value="/gio-hang/" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endif
@endsection
