@extends('layout.layout')
@section('content')

<div id="content">
    <div class="container">
        @include('layout.menu')
        <div id="top-banner" class="left right-content">
            <div class="left main-banner">
                <div class="box-slide">
                    <div class="owl-carousel owl-theme" id="slide-banner">
                        @foreach($homeSlides as $slide)
                        <div class="item">
                            @if(Helper::isMobile())
                            @if($slide->link)
                            <a href="{{$slide->link}}">
                                <img src="{{$slide->getImage(640)}}" alt="{{$slide->name}}">
                            </a>
                            @else
                            <img src="{{$slide->getImage(640)}}" alt="{{$slide->name}}">
                            @endif
                            @else
                            @if($slide->link)
                            <a href="{{$slide->link}}">
                                <img src="{{$slide->getImage(640)}}" alt="{{$slide->name}}">
                            </a>
                            @else
                            <img src="{{$slide->getImage(640)}}" alt="{{$slide->name}}">
                            @endif
                            @endif

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="left left-video  for-pc">
                 {!! Helper::getOption('video_index') !!}
            </div>
            <div class="left for-pc banner-advertise">
                {!! Helper::getOption('banner_advertise') !!}
            </div>
        </div>
        <div class="only-mobile quicklink clearfix">
            <div class="row">
                <div class="col-3">
                    <a href="javascript:void(0)" onclick="toggleMenu()">
                        <img src="/images/mobile/list.svg">
                        <p>Danh mục sản phẩm</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/category/tin-tuc-khuyen-mai">
                        <img src="/images/mobile/coupon.svg">
                        <p>Chương trình khuyến mãi</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/san-pham-da-xem">
                        <img src="/images/mobile/history.svg">
                        <p>Sản phẩm vừa xem</p>
                    </a>
                </div>
                <div class="col-3">
                    <a href="/xay-dung-cau-hinh">
                        <img src="/images/mobile/build.svg">
                        <p>Xây dựng cấu hình</p>
                    </a>
                </div>
            </div>
            <div id="product-sale-mb" class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/san-pham-khuyen-mai">Sản phẩm khuyến mãi</a></h3>
                    <a href="/san-pham-khuyen-mai" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="box-slide">
                    <div class="list-product slide-on-mobile pc-gaming-product" id="slide_salemb">
                        @foreach($promotionProducts as $item)
                        <div class="product-item" data-id="{{$item->id}}">
                            <a href="{{$item->getDetailLink()}}">
                                <div class="image">
                                    <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
        <!-- End top banner -->


        <!-- End product-sale -->
        <div class="clearfix"></div>
        <div id="main-content">
            <div class="left-content news-special for-pc">
                <div class="head heading">
                    <p>Tin tức nổi bật</p>
                </div>
                <div class="list-news">
                    <div class="box-slide">
                        <div class="owl-carousel owl-theme" id="news-special-slide">
                            @foreach($homePosts->split(4) as $items)
                            <div class="item">
                                @foreach($items as $item)
                                <div class="news-item">
                                    <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                        <img src="{{$item->getImage(350)}}" alt="{{$item->title}}">
                                        <div class="text">
                                            <i class="fa fa-forward"></i>
                                            <span>{{Helper::cutString($item->title,90)}}</span>
                                            <div class="time">
                                                <i class="fa fa-calendar-o"></i> {{Helper::formatDateFromString($item->published_at, 'd/m/Y')}} &nbsp;&nbsp;&nbsp;
                                                <i class="fa fa-clock-o"></i> {{Helper::formatDateFromString($item->published_at, 'H:i')}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        <div class="view-all">
                            <a href="/category/tin-tuc-noi-bat/" class="view-all">Xem tất cả</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End left content-->
            <div class="right-content for-pc">
                <div id="product-sale" class="left block-product">
                    <div class="heading">
                        <p>Sản phẩm khuyến mãi</p>
                        <a class="view-all" href="/san-pham-khuyen-mai">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="box-slide clearfix">
                        <div class="owl-carousel owl-theme list-product" style="overflow: hidden;" id="slide1">
                            @foreach($promotionProducts->split(2) as $items)
                            <div class="item">
                                @foreach($items as $item)
                                <div class="product-item ">
                                    <a href="{{$item->getDetailLink()}}">
                                        <div class="image">
                                            <img src="{{$item->getImage(280, 210)}}" />
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
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="banner left">
                    {!! Helper::getOption('banner_buildpc') !!}
                </div>
            </div>
            <!-- End right content-->

            <div class="clearfix"></div>
            <div class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/pc-workstation">PC, WORKSTATION</a></h3>
                    <a href="/pc-workstation" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile" id="workstationContent">
                    @foreach($pcWorkstationProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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

            <div class="clearfix"></div>
            <div class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/laptop">Laptop</a></h3>
                    <ul>
                        <li><a href="/laptop/laptop-asus">Laptop Asus</a></li>
                        <li><a href="/laptop/laptop-dell">Laptop Dell</a></li>
                        <li><a href="/laptop/laptop-hp">Laptop HP</a></li>
                        <li><a href="/laptop/laptop-acer">Laptop Acer</a></li>
                        <li><a href="/laptop/laptop-lenovo">Laptop Lenovo</a></li>
                    </ul>
                    <a href="/laptop" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($laptopProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <div class="clearfix"></div>
            <div class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/pc-gamer">PC GAMING</a></h3>
                    <a href="/pc-gamer" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($pcGamingProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <div class="clearfix"></div>
            <div class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/cpu-bo-vi-xu-ly">Cpu - Bộ vi xử lý</a></h3>
                    <ul>
                        <li><a href="/cpu-bo-vi-xu-ly/cpu-intel">CPU Intel</a></li>
                        <li><a href="/cpu-bo-vi-xu-ly/cpu-amd">CPU AMD</a></li>
                    </ul>
                    <a href="/cpu-bo-vi-xu-ly" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($cpuProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <div class="clearfix"></div>
            <div class="main-product  block-product">
                <div class="head heading">
                    <h3><a href="/mainboard-bo-mach-chu">Main - Bo mạch chủ</a></h3>
                    <ul>
                        <li><a href="/mainboard-bo-mach-chu/main-asus">Main Asus</a></li>
                        <li><a href="/mainboard-bo-mach-chu/main-asrock">Main Asrock</a></li>
                        <li><a href="/mainboard-bo-mach-chu/main-gigabyte">Main Gigabyte</a></li>
                        <li><a href="/mainboard-bo-mach-chu/main-msi">Main MSI</a></li>
                    </ul>
                    <a href="/mainboard-bo-mach-chu" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($mainProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <div class="clearfix"></div>
            <div class="main-product block-product">
                <div class="head heading">
                    <h3><a href="/vga-card-man-hinh">VGA - Card màn hình</a></h3>
                    <ul>
                        <li><a href="/vga-card-man-hinh/asus-vga-card-man-hinh">VGA Asus</a></li>
                        <li><a href="/vga-card-man-hinh/colorful-vga-card-man-hinh">VGA Colorful</a></li>
                        <li><a href="/vga-card-man-hinh/gigabyte-vga-card-man-hinh">VGA Gigabyte</a></li>
                        <li><a href="/vga-card-man-hinh/msi-vga-card-man-hinh">VGA MSI</a></li>
                        <li><a href="/vga-card-man-hinh/quadro-vga-card-man-hinh">VGA Quadro</a></li>
                        <li><a href="/vga-card-man-hinh/amd-vga-card-man-hinh">VGA AMD</a></li>
                    </ul>
                    <a href="/vga-card-man-hinh" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($vgaProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <div class="clearfix"></div>
            <div class="main-product  block-product">
                <div class="head heading">
                    <h3><a href="/monitor-man-hinh">Monitor - Màn hình</a></h3>
                    <ul>
                        <li><a href="/monitor-man-hinh/man-hinh-asus">Màn hình Asus</a></li>
                        <li><a href="/monitor-man-hinh/man-hinh-aoc">Màn hình AOC</a></li>
                        <li><a href="/monitor-man-hinh/man-hinh-lg">Màn hình LG</a></li>
                        <li><a href="/monitor-man-hinh/man-hinh-coolermaster">Màn hình Coolermaster</a></li>
                        <li><a href="/monitor-man-hinh/man-hinh-dell">Màn hình Dell</a></li>
                        <li><a href="/monitor-man-hinh/man-hinh-viewsonic">Màn hình Viewsonic</a></li>
                    </ul>
                    <a href="/monitor-man-hinh" class="view-all">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </div>
                <div class="list-product pc-gaming-product five-column slide-on-mobile">
                    @foreach($monitorProducts as $item)
                    <div class="product-item" data-id="{{$item->id}}">
                        <a href="{{$item->getDetailLink()}}">
                            <div class="image">
                                <img src="{{$item->getImage(280, 210)}}" alt="{{$item->name}}" />
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
            <!--     <div class="partner">
                    <div class="box-slide">
                        <div class="owl-carousel owl-theme list-product" id="slide2">
                            @foreach($homeBrands as $brand)
                            <div class="item">
                                <img src="{{asset($brand->image)}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> -->
            <?php Helper::getOption('site_popup') ?>
            @if(Helper::getOption('site_popup') == '1' && Helper::getOption('site_popup_html'))
            <div id="salePopup" style="display:none" class="sale-popup">
                <div class="popup-content">
                    <button type="button" class="close">&times;</button>
                    {!! Helper::getOption('site_popup_html') !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
