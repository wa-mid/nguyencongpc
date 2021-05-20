@extends('layout.layout')

@push('head')
	@if(!empty($product->meta_pixel))
		{!! $product->meta_pixel !!}
	@endif
@endpush
@section('content')
    <div id="content">
        <div class="container">
            @include('layout.menu')
            <div class="product-detail" itemscope itemtype="https://schema.org/Product">
                <div class="main-info">
                    <div class="breadcrumb for-pc">
                        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/')}}">
                                    <span itemprop="name">Trang chủ</span></a>
                                <meta itemprop="position" content="1"/>
                                <i class="fa fa-angle-double-right"></i>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/cua-hang')}}">
                                    <span itemprop="name">Sản phẩm</span></a>
                                <meta itemprop="position" content="2"/>
                                <i class="fa fa-angle-double-right"></i>
                            </li>
                            @foreach($productCategories as $category)
                                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a itemtype="http://schema.org/Thing" itemprop="item" href="{{$category->getDetailLink()}}">
                                        <span itemprop="name">{{$category->name}}</span></a>
                                    <meta itemprop="position" content="3"/>
                                    <i class="fa fa-angle-double-right"></i>
                                </li>
                            @endforeach
                            <li>
                                <strong>{{$product->name}}</strong>
                            </li>
                        </ol>
                    </div>
					@if(!Helper::isMobile())
						<h1 itemprop="name" class="product-name for-pc">{{$product->name}}</h1>
					@endif
                    <div class="left-content">
                        <div class="product-images">
                            <div class="box-slide">
                                <div class="owl-carousel owl-theme" id="product-images">
                                    @foreach($product->getImages() as $pImage)
                                        <div class="item">
                                            <a href="{{asset($pImage)}}" data-fancybox="gallery">
                                                <img itemprop="image" alt="{{$product->name}}"  src="{{Helper::getThumbnail($pImage, 900)}}" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
						@if(Helper::isMobile())
							<h1 itemprop="name" class="product-name only-mobile">{{$product->name}}</h1>
						@endif

                        <div  class="only-mobile">
                                 <div class="price" itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer">
                                {!! $product->getSaleLable() !!}
                                <p class="old-price">{{Helper::formatMoney($product->getOldPriceLabel())}}</p>
                                <p class="new-price">{{Helper::formatMoney($product->getPriceLabel())}}</p>
                                <meta itemprop="highPrice" content="{{$product->getOldPriceLabel()}}" />
                                <meta itemprop="lowPrice" content="{{$product->getPrice()}}" />
                                <meta itemprop="offerCount" content="{{$product->amount > 0 ? $product->amount : 1}}" />
                                <meta itemprop="priceCurrency" content="VND" />
                                <div style="overflow: hidden;">
                                    <span class="status">
                                        <label>Tình trạng: </label>
                                         <span {{$product->getStatusStyle()}} >{{$product->getStatusText()}}</span>
                                    </span>
                                    @if($product->warranty)
                                        <span class="warr">
                                            <label>Bảo hành: </label>
                                            {{$product->warranty}}
                                        </span>
                                    @endif
                                </div>
                                <p class="product-note"> {!!$product->promotion!!}</p>
                                
                            </div>
                            <div>
                                {!! Helper::getOption('qr_code') !!}
                            </div>
                            <div class="product-support clearfix mgy10">
                                <ul class="support">
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ tư vấn lắp đặt trong nội thành Hà Nội.</li>
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ mua hàng trả góp.</li>
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ cài đặt các phần mềm đồ họa.</li>
                                    <li><i class="fa fa-check-circle"></i> Được tham gia các chương trình giảm giá sốc.</li>
                                </ul>
                            </div>
                        </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item" data-target="tab-profile">
                            <a class="nav-link active" href="javascript:void(0)">Thông số</a>
                        </li>
                        <li class="nav-item" data-target="tab-home">
                            <a class="nav-link " href="javascript:void(0)" >Đặc điểm</a>
                        </li>
                        <li class="nav-item" data-target="tab-media">
                            <a class="nav-link" href="javascript:void(0)">Video</a>
                        </li>
                        <!--
                        <li class="nav-item" data-target="tab-rating">
                            <a class="nav-link" href="javascript:void(0)">Đánh giá</a>
                        </li>
                        -->
                        <li class="nav-item" data-target="tab-comment">
                            <a class="nav-link" href="javascript:void(0)">Bình luận</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        @if(!empty(array_intersect($categoryIds->toArray(), [104,408,1829])))
                            <div class=""  id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h2 class="font-weight-bold caption">Thông số kỹ thuật</h2>
                                {!! $product->profile !!}
                            </div>
                            <div class="" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                                <h2 class="font-weight-bold caption">Giới thiệu sản phẩm {{$product->name}}</h2>
                                <div itemprop="description">{!! $product->content !!}</div>
                            </div>
                        @else 
                            <div class="" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                                <h2 class="font-weight-bold caption">Giới thiệu sản phẩm {{$product->name}}</h2>
                                <div itemprop="description">{!! $product->content !!}</div>
                            </div>
                            <div class=""  id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h2 class="font-weight-bold caption">Thông số kỹ thuật</h2>
                                {!! $product->profile !!}
                            </div>
                        @endif
                        @if($product->video)
                        <div class="" id="tab-media" role="tabpanel" >
                            <h3 class="font-weight-bold caption">Video sản phẩm</h3>
                            @if(substr($product->video, 0, 8) == 'https://')
                                <iframe width="100%" height="550px" src="{{$product->video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                {!! $product->video !!}
                            @endif
                        </div>
                        @endif
						@if(count($product->getTagLinks()))
                        <div>
							Từ khóa:
                            {!! implode(', ', $product->getTagLinks()) !!}
                        </div>
                        @endif
                        <!--
                        <div class="" id="tab-rating" role="tabpanel">
                            <h4 class="font-weight-bold caption">Đánh giá</h4>
                            Đang cập nhật
                        </div>
                        -->
                        <div class="post-share">
                            <?php $url = str_replace('http://', 'https://', url()->full());?>
                            <a href="https://www.facebook.com/sharer.php?u={{$url}}" class="s-fb" style="width: 40px;height: 40px;background: #45629f;display: inline-block;text-align: center;color: #fff;font-size: 20px;line-height: 40px;">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{$url}}" class="s-tw" style="width: 40px;height: 40px;background: #5eb2ef;display: inline-block;text-align: center;color: #fff;font-size: 20px;line-height: 40px;">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?url={{$url}}" class="s-linke" style="width: 40px;height: 40px;background: #0083bb;display: inline-block;text-align: center;color: #fff;font-size: 20px;line-height: 40px;">
                                <i class="fa fa-linkedin-square"></i>
                            </a>
                            <a href="https://www.pinterest.com/pin/create/bookmarklet/?pinFave=1&amp;url={{$url}}"class="s-pin" style="width: 40px;height: 40px;background: #cf2830;display: inline-block;text-align: center;color: #fff;font-size: 20px;line-height: 40px;">
                                <i class="fa fa-pinterest"></i>
                            </a>
                            <a href="https://www.blogger.com/blog_this.pyra?t&u={{$url}}&n={{$product->name}}"class="s-blogger" style="width: 40px;height: 40px;display: inline-block;">
                               <img src="https://nguyencongpc.vn/photos/shares/icon-blogger.jpg" alt="share blogger" style="margin: -8px 0 0;">
                            </a>
                            <div style="position: absolute;margin-left: 5px;" class="zalo-share-button" data-href="" data-oaid="2360590838383636184" data-layout="4" data-color="blue" data-customize=false></div>
                        </div>
                        <div class="" id="tab-comment" role="tabpanel">
                            <h4 class="font-weight-bold caption">Bình luận</h4>
                            <div class="fb-comments" data-href="{{str_replace('http://', 'https://', url()->full())}}" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
                        </div>
                    </div>
                    <div class="only-mobile botton-action">
                        <ul class="action-1">
                            <li>
                                <a href="https://m.me/MAY.TINH.NGUYEN.CONG"><img src="/images/mobile/m-chat.svg"></a>
                            </li>
                            <li style="margin-left: 10px;">
                                <a class="list-phone" data-toggle="modal" data-target="#modal-contact" href="javascript:void(0)" title="Liên hệ với hotline">GỌI MUA NGAY</a>
                            </li>
                            <!-- <li>
                                <a href="/xay-dung-cau-hinh"><img style="width: 33px;margin:3px" src="/images/mobile/build.svg"></a>
                            </li> -->
                        </ul>
                        <div class="action-2">
                            @if($product->getPrice() > 0 && $product->status == 1)
                                <form class="cart pinfo_cart" action="{{url('/gio-hang')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="action" value="addproduct">
                                    <input id="option-product-qty" type="hidden" name="quantity" value="1">
                                    <input id="option-product-id" type="hidden" name="product_id" value="{{$product->id}}">
                                    <button type="submit" class="buy">
                                        ĐẶT HÀNG
                                    </button>
                                </form>
                            @else 
                                    <div>
                                        <a href="https://m.me/MAY.TINH.NGUYEN.CONG" style="background: #007bff;color: #fff;font-size: 15px;padding: 10px;border-radius: 3px;display: block;text-align: center;">LIÊN HỆ</a>
                                    </div>
                            @endif
                        </div>
                    </div>
                        
                </div>
           
                <div class="right-content">
                            <div  class="hidden-mobile">
                                 <div class="price" itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer">
                                {!! $product->getSaleLable() !!}
                                <p class="old-price">{{Helper::formatMoney($product->getOldPriceLabel())}}</p>
                                <p class="new-price">{{Helper::formatMoney($product->getPriceLabel())}}</p>
                                <meta itemprop="highPrice" content="{{$product->getOldPriceLabel()}}" />
                                <meta itemprop="lowPrice" content="{{$product->getPrice()}}" />
                                <meta itemprop="offerCount" content="{{$product->amount > 0 ? $product->amount : 1}}" />
                                <meta itemprop="priceCurrency" content="VND" />
                                <p class="product-note"> {!!$product->promotion!!}</p>
                                <div style="overflow: hidden;">
                                    <span class="status">
                                        <label>Tình trạng: </label>
                                         <span {{$product->getStatusStyle()}} >{{$product->getStatusText()}}</span>
                                    </span>
                                    @if($product->warranty)
                                        <span class="warr">
                                            <label>Bảo hành: </label>
                                            {{$product->warranty}}
                                        </span>
                                    @endif
                                </div>
                                @if($product->getPrice() > 0 && $product->status == 1)
                                    <div class="call">
                                        <a class="list-phone" data-toggle="modal" data-target="#modal-contact" href="javascript:void(0)" title="Liên hệ với hotline">
                                            GỌI MUA NGAY
                                        </a>
                                    </div>
                                    <form class="cart pinfo_cart" action="{{url('/gio-hang')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="action" value="addproduct">
                                        <input id="option-product-qty" type="hidden" name="quantity" value="1">
                                        <input id="option-product-id" type="hidden" name="product_id" value="{{$product->id}}">
                                        <button type="submit" class="buy">
                                            ĐẶT HÀNG
                                        </button>
                                    </form>
                                @else 
                                    <div>
                                        <a href="https://m.me/MAY.TINH.NGUYEN.CONG" style="background: #007bff;color: #fff;font-size: 18px;padding: 10px;border-radius: 3px;display: block;text-align: center;">LIÊN HỆ</a>
                                    </div>
                                @endif
                                
                            </div>
                            <div>
                                {!! Helper::getOption('qr_code') !!}
                            </div>
                            <div class="product-support clearfix mgy10">
                                <ul class="support">
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ tư vấn lắp đặt trong nội thành Hà Nội.</li>
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ mua hàng trả góp.</li>
                                    <li><i class="fa fa-check-circle"></i> Hỗ trợ cài đặt các phần mềm đồ họa.</li>
                                    <li><i class="fa fa-check-circle"></i> Được tham gia các chương trình giảm giá sốc.</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="buttons">
                            <div class="rate mb-20">
                                <div class="box-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                                
                                    <div class="rate-title"><span class="rate-lable">Đánh giá </span>(<span id="rate_count" itemprop="ratingCount">{{$product->total_rate}}</span> lượt)</div>
                                    <div id="star" data-score="{{$product->score}}" style="cursor: pointer;"></div>
                                    <div>
                                        <div id="div_average" style="float: left; line-height: 16px; margin: 0 5px; {!! $product->score ? 'display:none;' : '' !!}">(<span class="average" id="average" itemprop="ratingValue">{{$product->score}}</span> đ)</div>
                                        <span id="hint"></span>
                                        <meta itemprop="bestRating" content="10"/><meta itemprop="worstRating" content="0"/>
                                        <input id="p_id" type="hidden" value="{{$product->id}}">
                                        <input id="u_id" type="hidden" value="{{Auth::check() ? Auth::user()->id : ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="fb-like"
                                 data-href="https:nguyencongpc.vn"
                                 data-layout="button_count"
                                 data-action="like"
                                 data-ref=""
                                 data-share="true"
                                 data-size="large"
                                 data-show-faces="false">

                            </div>
                            <style>.zalo-follow-only-button iframe {background: #03a5fa;width: 85px;height: 28px;margin-right: 5px;border-radius: 3px;}</style>
                            <div style="float: left;" class="zalo-follow-only-button" data-oaid="2360590838383636184"></div>
                        </div>
                    <div class="product-related">
                        <div class="head">
                            <p>Sản phẩm liên quan</p>
                        </div>
                        <div class="list-product">
                            @foreach($relatedProducts as $item)
                                <div class="product-item" data-id="{{$item->id}}">
                                    <a href="{{$item->getDetailLink()}}">
                                        <div class="image">
                                            <img src="{{$item->getImage(426, 320)}}">
                                        </div>
                                        <p class="text">
                                            <span class="name">{{$item->name}}</span>
                                            <span class="new-price">{{Helper::formatMoney($item->getPriceLabel())}}</span>
                                            <span class="old-price">{{Helper::formatMoney($item->getOldPriceLabel())}}</span>
                                            {!! $item->getSaleLable() !!}
                                        </p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('bottom')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#product-images").owlCarousel({
                loop: true,
                nav: true,
				autoplay:true,
                dots:true,
                items:1,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            });
            $("a[rel=example_group]").fancybox({
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'titlePosition' 	: 'over',
				'loop'				: true,
                'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                }
            });

            $(".nav-item").click(function() {
                $(".nav-link").removeClass('active');
                $(this).find('.nav-link').addClass('active');
                var elm = $(this).attr('data-target');
                $('html, body').animate({
                    scrollTop: $("#"+elm).offset().top - 150
                }, 500);
            });

            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if(scroll > 710){
                    $(".nav-tabs").addClass('fixtop');
                }else{
                    $(".nav-tabs").removeClass('fixtop');
                }
            });

            $('.list-phone').click(function (e) {
                $('#modal-contact .modal-content').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><style type="text/css">#modal-contact .item-people a, #modal-contact span {display: inline-block;}.item-people {display: block;}</style><div class="dropdown-item"><p><b>TƯ VẤN LINH KIỆN - BUILD PC:</b></p><div class="item-people"><h7 style="display: block;color: red;">Chi Nhánh 377 - 379 Trương Định, HN:</h7><a style="margin-left: 20px;font-weight: bold;" href="tel:0945020999">0945020999</a><span>Mr Hòa</span></div><div class="item-people"><h7 style="display: block;color: red;">Chi Nhánh 52 Trần Phú, HN:</h7><a style="margin-left: 20px;font-weight: bold;" href="tel:0866666366">0866666366</a><span>Mr Tùng</span></div><div class="item-people"><h7 style="display: block;color: red;">Chi Nhánh 176 Tân Phước, Q10, HCM:</h7><a style="margin-left: 20px;font-weight: bold;" href="tel:0707086666">0707086666</a><span>Mr Tuấn</span></div></div><div class="dropdown-item"><p><b>TƯ VẤN LAPTOP:</b></p><div class="item-people"><a style="margin-left: 20px;font-weight: bold;" href="tel:0866666266">0866666266</a><span>Mr Lịch</span></div></div><div class="dropdown-item"><p><b>TƯ VẤN GAMING GEAR:</b></p><div class="item-people"><a style="margin-left: 20px;font-weight: bold;" href="tel:0979999191">0979999191</a><span>Mr Huy</span></div></div>');
            });
        })
    </script>
@endpush
