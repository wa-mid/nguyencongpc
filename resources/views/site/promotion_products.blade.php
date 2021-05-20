@extends('layout.layout')
@section('content')
    <div id="content">
    <div class="container">
        <div class="product-category product-filter">
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
                    <li>
                        <h1 style="font-weight: bold;font-size: 14px;display: inline-block;">Sản phẩm khuyến mại</h1>
                    </li>
                </ol>
            </div>
            <div class="main-content">
                <div class="left-content left-content-cate left">
                    @include('layout.menu')
                </div>
                <div class="right-content">
                    

                    <div class="main-product">
                        <div class="active-left-content for-pc">
                            <div class="container">
                                <div id="btn-active-left-content" class="left">
                                    <div class="opened">
                                        <i class="fa fa-bars"></i>
                                        <span>Danh mục sản phẩm</span>
                                    </div>
                                    <div class="closed">
                                        <i class="fa fa-close"></i>
                                        <span>Đóng</span>
                                    </div>
                                </div>
                                <div class="option order right">
                                    <select id="sort-select" data-url="{{Helper::getUrlParameters(['sort','page'])}}">
                                        <option value="moi-nhat" {{isset($sort) && $sort == 'moi-nhat' ? 'selected' : ''}}>Mới nhất</option>
                                        <option value="gia-tang-dan" {{isset($sort) && $sort == 'gia-tang-dan' ? 'selected' : ''}}>Giá tăng dần</option>
                                        <option value="gia-giam-dan" {{isset($sort) && $sort == 'gia-giam-dan' ? 'selected' : ''}}>Giá giảm dần</option>
                                    </select>
                                </div>
                            </div>
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
                                        <div id="popup-product-{{$item->id}}" class="popup-hover-product">
                                            <div class="top">
                                                <span class="name">{{$item->name}}</span>
                                                <img src="/images/intel.png" />
                                            </div>
                                            <div class="body">
                                                <div class="left">
                                                    <img src="{{$item->getImage(280, 210)}}"/>
                                                </div>
                                                <div class="left">
                                                    <p class="price">{{Helper::formatMoney($item->getPriceLabel())}}</p>
                                                    <p class="old-price">{{Helper::formatMoney($item->getOldPriceLabel())}}</p>
                                                    <p class="vat"><strong>VAT:</strong> đã bao gồm</p>
                                                    @if($item->warranty)
                                                        <p class="gua"><strong>Bảo hành:</strong> <span style="color:#ff0000">{{$item->warranty}}</span></p>
                                                    @endif
                                                    <p class="rate"></p>
                                                </div>
                                                @if($item->description)
                                                    <div class="des">
                                                        <p class="cap">Mô tả sản phẩm</p>
                                                        <div class="content">
                                                            {!! $item->description !!}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($item->promotion)
                                                    <div class="promotion">
                                                        <p class="cap">Khuyến mại</p>
                                                        <div class="content">
                                                            {!! $item->promotion !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
    <script>
	    $(document).ready(function(){
		    $("#btn-active-left-content").click(function(){
               $(".product-category").toggleClass('active-filter');
            });

            /*--Fix top menu--*/
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if(scroll > 260){
                    $(".active-left-content").addClass('fixtop');
                    $(".left-content-cate").addClass('fixtop');

                }else{
                    $(".active-left-content").removeClass('fixtop');
                    $(".left-content-cate").removeClass('fixtop');
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
	    })
    </script>

@endsection
