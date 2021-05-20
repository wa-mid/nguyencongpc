@extends('layout.layout')
@section('content')
    <style type="text/css" media="screen">
            /*.active-filter .left-content-cate.fixtop {
                top: 75px;
            }
            
            .active-filter .left-content-cate.fixtop .menu-cate ul{
                display: none;
            }*/

            @media (min-width: 1024px) {
                .active-filter .left-content-cate.fixtop {
                    top: 75px;
                }
                .active-filter .left-content-cate.fixtop #main-menu .head.for-pc,
                .active-filter .left-content-cate.fixtop .left-content.menu-cate.open.clicked ul,
                .left-content-cate > .block-filter
                {
                    display: block;
                }
            }
            @media (max-width: 1024px) {
                .product-category.active-filter .main-content .right-content {
                    width: 100%;
                }

            }
            /* css category*/
          
    </style>
    <div id="content">
    <div class="container">
        <div class="product-category product-filter  active-filter">
            <div class="breadcrumb for-pc">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/')}}">
                            <span itemprop="name">Trang chủ</span></a>
                        <meta itemprop="position" content="1"/>
                        <i class="fa fa-angle-double-right"></i>
                    </li>
                    @if(isset($category))
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/cua-hang')}}">
                                <span itemprop="name">Sản phẩm</span></a>
                            <meta itemprop="position" content="2"/>
                            <i class="fa fa-angle-double-right"></i>
                        </li>
                        @if($rootParent)
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemtype="http://schema.org/Thing" itemprop="item" href="{{$rootParent->getDetailLink()}}">
                                    <span itemprop="name">{{$rootParent->name}}</span></a>
                                <meta itemprop="position" content="3"/>
                                <i class="fa fa-angle-double-right"></i>
                            </li>
                        @endif
                        <li>
                            <strong>{{$category->name}}</strong>
                        </li>
                    @else
                        <li>
                            <strong>Cửa hàng</strong>
                        </li>
                    @endif
                </ol>
            </div>
            <div class="banner-promotion">
				@if(isset($category))
                <div class="banner-left">
                    <div class="box-slide">
                        <div class="owl-theme owl-carousel for-pc" id="banner-promotion-slide-pc">

                            @foreach($category->getSlides() as $slide)
                                <div class="item">
                                    <a href="{{$slide->link}}">
                                        <img src="{{$slide->image}}" alt="" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-slide">
                        <div class="owl-theme owl-carousel only-mobile" id="banner-promotion-slide-mobile">

                            @foreach($category->getMobileSlides() as $slide)
                                <div class="item">
                                    <img src="{{$slide->image}}" alt="" >
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="banner-right right for-pc">
                    <div class="box-slide">
                        <div class="owl-theme owl-carousel for-pc" id="banner-promotion-slide-pc2">
                            @foreach($category->getSlides2() as $slide)
                                <div class="item">
                                    <a href="{{$slide->link}}">
                                        <img src="{{$slide->image}}" alt="" >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
				@endif
            </div>
            <div class="main-content">

                <div class="left-content left-content-cate left">
                    <div class="seach-menu">
                        @include('layout.menu')
                    </div>
                    @include('layout.filter')
                </div>
                <div class="right-content">
                    <div class="main-product">
                        <div class="active-left-content for-pc">
                            <div class="container">
                                <h5 style="display: inline-block;font-size: 16px;">Sản phẩm khuyến mại</h5>
                                <div class="option order right">
                                    <select id="sort-select" data-url="{{Helper::getUrlParameters(['sort','page'])}}">
                                        <option value="moi-nhat" {{isset($sort) && $sort == 'moi-nhat' ? 'selected' : ''}}>Mới nhất</option>
                                        <option value="gia-tang-dan" {{isset($sort) && $sort == 'gia-tang-dan' ? 'selected' : ''}}>Giá tăng dần</option>
                                        <option value="gia-giam-dan" {{isset($sort) && $sort == 'gia-giam-dan' ? 'selected' : ''}}>Giá giảm dần</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(isset($promotionProducts) && !$promotionProducts->isEmpty())

                            <div class="">
                                @if(count($promotionProducts))
                                    <div class="box-slide">
                                        <div id="slide-product-promotion" class="owl-carousel owl-theme list-product">


                                    @foreach($promotionProducts as $item)
                                        <div class="product-item product-sale" data-id="{{$item->id}}">
                                            <a href="{{$item->getDetailLink()}}">
                                                <div class="image">
                                                    <img src="{{$item->getImage(426, 320)}}" alt="{{$item->name}}" />
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
                                @else
                                    <p class="text-center">Không tìm thấy sản phẩm.</p>
                                @endif
                            </div>
                        @endif
                        <div class="head">
                            <h1>{{isset($category) ? $category->name : 'Cửa hàng'}}</h1>
                        </div>
                        <div class="list-product workstation-product grid-two-on-mobile">
                            @if(count($result))
                                @foreach($result as $item)
                                    <div class="product-item" data-id="{{$item->id}}">
                                        <a href="{{$item->getDetailLink()}}">
                                            <div class="image">
                                                <img src="{{$item->getImage(426, 320)}}" alt="{{$item->name}}" />
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
                            @else
                                <p class="text-center">Không tìm thấy sản phẩm.</p>
                            @endif
                        </div>
                        <div class="div-pagination">
                            {!! $result->onEachSide(1)->appends(Request::all())->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
@endsection

@push('bottom')
	<script>
        $(document).ready(function () {
            var md = new MobileDetect(window.navigator.userAgent);
            if(md.mobile() !== null){
                $("#banner-promotion-slide-mobile").owlCarousel({
                    items:1,
                    autoplay:true,
                    autoplayTimeout:2000,
                    navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    dots:false,
                    nav: true,
                    loop:true,
                });
                $("#banner-promotion-slide-pc").remove();
                $("#banner-promotion-slide-pc2").remove();
            }else{
                $("#banner-promotion-slide-pc").owlCarousel({
                    items:1,
                    autoplay:true,
                    autoplayTimeout:2000,
                    navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    dots:false,
                    nav: true,
                    loop:true,
                });
                $("#banner-promotion-slide-pc2").owlCarousel({
                    items:1,
                    autoplay:true,
                    autoplayTimeout:2000,
                    navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    dots:false,
                    nav: true,
                    loop:true,
                });
                $("#banner-promotion-slide-mobile").remove();
            }

            $("#slide-product-promotion").owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots:false,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                },
                autoplay:true,
                autoplayTimeout:3000,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            });
            $("#btn-active-left-content").click(function(){
               $(".product-category").toggleClass('active-filter');
            });

            /*--Fix top menu--*/
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if ($(".right-content").height() > 500) {
                    if(scroll > 500){
                        $("#main-menu").removeClass("open");
                        $(".active-left-content").addClass('fixtop');
                        $(".left-content-cate").addClass('fixtop');

                    }else{
                        $(".active-left-content").removeClass('fixtop');
                        $(".left-content-cate").removeClass('fixtop');
                        $(".filter-content").removeClass("hidden");
                    }
                }
            });

            $("#main-menu.menu-cate .head.for-pc").click(function () {
                var $menu_home = $("#main-menu");
                var scroll = $(window).scrollTop();
                var $menu_cate = $("#main-menu.menu-cate");
                if($menu_cate.hasClass("open")){
                    console.log('1');
                    $menu_cate.removeClass("open");
                }else{
                    console.log('2');
                    $menu_cate.addClass("open");
                    $menu_cate.addClass("clicked");
                }

            });

            $(".filter-content").mouseover(function() {
                $(this).css({"overflow-y": "scroll", "height": "500px"});
            });
            // $("#boxFilter").mouseout(function() {
            //     $(this).removeAttr( 'style' );
            // });

        })
    </script>
@endpush
