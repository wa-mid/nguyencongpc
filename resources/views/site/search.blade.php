@extends('layout.layout')
@section('content')
    <style type="text/css" media="screen">
        #boxFilterPC {
            width: 100%;
            margin: auto;
            height: auto;
        }

        #boxFilterPC .box-header {
            background: linear-gradient(90deg, rgba(224,32,32,1) 0%, rgba(255,202,0,1) 100%);
            padding: 6px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }
        #boxFilterPC .box-list .list-body{
            background: #007bff21;
            padding: 10px;
            margin-bottom: 10px;
        }
        #boxFilterPC .box-list h4 {
            background: #0069ff40;
            padding: 5px 9px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            border-left: 4px solid #307fbe;
        }
        #boxFilterPC .box-list .list-body .flexed {
            padding: 5px 0;
            cursor: pointer;
        }
        .active-filter .seach-menu #main-menu {
            margin-bottom: 20px;
        }
        .active-filter .product-filter #main-menu {
            max-height: 35px;
        }

        .active-filter .left-content-cate.fixtop #main-menu .head.for-pc,
        .active-filter .left-content-cate.fixtop .left-content.menu-cate.open.clicked ul
        {
            display: block;
        }
        .active-filter .left-content-cate.fixtop .menu-cate ul{
            display: none;
        }

        .left-content-cate.left.fixtop #boxFilterPC {
            background: #fff;
        }
        .active-filter .box-header, .box-list h4{
            cursor: pointer;
        }
        .active-filter .box-list h4 > i {
            float: right;
            margin: 0 !important;
            line-height: 15px;
        }
        @media (min-width: 1024px){
            .active-filter .left-content-cate.fixtop {
                top: 75px;
            }
        }
        @media (max-width: 1024px) {
            .product-category.active-filter .main-content .right-content {
                width: 100%;
            }
           
            #suggest-search {
                top: 90px;
            }
            .fixtop #suggest-search {
                top: 50px;
            }
        }
    </style>
    <div id="content">
    <div class="container">
        <div class="product-category product-filter  active-filter" id="category-page">
            <div class="breadcrumb for-pc">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/')}}">
                            <span itemprop="name">Trang chủ</span></a>
                        <meta itemprop="position" content="1"/>
                        <i class="fa fa-angle-double-right"></i>
                    </li>
                    <li>
                        <strong>Tìm kiếm</strong>
                    </li>
                </ol>
            </div>
            <div class="">
                <h1 style="font-size: 14px;margin-bottom: 10px">Tìm thấy {{$totalResult}} sản phẩm liên quan đến "<strong>{{$term}}</strong>"</h1>
            </div>
            <div class="menu-search-mb">
                <div class="filter left only-mobile" style="width: 100%;">
                    <button type="button" id="search-filters" style="width: 100%;background: linear-gradient(90deg, rgba(224,32,32,1) 0%, rgba(255,202,0,1) 100%);    border: 0px;padding: 5px;color: #fff;">Bộ Lọc Sản Phẩm</button>
                </div>
            </div>
            <div class="main-content">
                <div class="left-content left-content-cate left">
                    <div class="block block-filter" id="boxFilter" data-url="{{url('/tim-kiem?q='.urlencode($term))}}">
                        <div class="head head-filter">
                            <span class="left">
                                <i class="fa fa-filter"></i>
                                Bộ lọc
                            </span>
                            <span class="right only-mobile">
                                <i class="fa fa-close btn-close-filter"></i>
                            </span>
                        </div>
                        <ul class="">
                            <li class="active">
                                <div class="head">
                                    <span>Lọc theo danh mục sản phẩm</span>
                                    <i class="fa fa-caret-up"></i>
                                </div>
                                <div class="body">
									@if(count($categoryCount))
										@foreach(Helper::getProductCategories() as $rootItem)
											@if(in_array($rootItem['id'], array_keys($categoryCount)))
												<div class="flex category {{isset($filter['category']) && in_array($rootItem['id'], $filter['category']) ? 'active' : ''}}" data-filter="{{$rootItem['id']}}">
													<span>{{$rootItem['name']}} ({{$categoryCount[$rootItem['id']]}})</span>
												</div>
											@endif
										@endforeach
									@endif
                                </div>
                            </li>
                            <li class="">
                                <div class="head">
                                    <span>Lọc theo thương hiệu</span>
                                    <i class="fa fa-caret-up"></i>
                                </div>
                                <div class="body">
                                    @if(count($brandCount))
                                        @foreach($brandFilterList as $item)
                                            @if(in_array($item->id, array_keys($brandCount)))
                                                <div class="flex brand {{!empty($filter['brand']) && (in_array($item->id, $filter['brand'])) ? 'active' : ''}}" data-filter="{{$item->id}}" >
                                                    <span>{{$item->name}} ({{$brandCount[$item->id]}})</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </li>
                            <li class="">
                                <div class="head">
                                    <span>Khoảng giá</span>
                                    <i class="fa fa-caret-up"></i>
                                </div>
                                <div class="body">
                                    @foreach($priceFilterList as $item)
                                        <div class="flex price {{!empty($filter['price']) && (in_array($item['slug'], $filter['price'])) ? 'active' : ''}}" data-filter="{{$item['slug']}}" >
                                            <span>{{$item['name']}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <div class="buttons">
                            <a href="{{url('/tim-kiem?q='.urlencode($term))}}"><span  class="delete">Xóa bộ lọc</span></a>
                            <span class="apply" id="btnFilterSubmit">Áp dụng</span>
                        </div>
                    </div>
                    <div class="seach-menu">
                        @include('layout.menu')
                    </div>

                    @if ($totalResult > 0)
                        <div class="block-filter-cate for-pc" id="boxFilterPC" data-url="{{url('/tim-kiem?q='.urlencode($term))}}" >
                            <div class="box-header btn-active-left-content" >
                                <span>Bộ lọc sản phẩm</span>
                            </div>
                            <div class="filter-content">
                                <div class="box-list btn-active-left-content">
                                    <h4>
                                        Danh mục
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </h4>
                                    <div class="list-body cat-list {{!empty($filter['category']) ? 'active' : ''}}">
                                    @if(count($categoryCount))
                                        @foreach(Helper::getProductCategories() as $rootItem)
                                            @if(in_array($rootItem['id'], array_keys($categoryCount)))
                                                <div class="flexed category {{isset($filter['category']) && in_array($rootItem['id'], $filter['category']) ? 'active' : ''}}" data-filter="{{$rootItem['id']}}" >
                                                    <i class="fa  {{isset($filter['category']) && in_array($rootItem['id'], $filter['category']) ? 'fa-check-square' : 'fa-square-o'}} " aria-hidden="true"></i>
                                                    <span>{{$rootItem['name']}} ({{$categoryCount[$rootItem['id']]}})</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <div class="box-list ">
                                    <div class="cat-list">
                                        <h4>
                                            Thương hiệu
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </h4>
                                        <div class="list-body {{!empty($filter['brand']) ? '' : 'hidden'}}">
                                            @if(count($brandCount))
                                                @foreach($brandFilterList as $item)
                                                    @if(in_array($item->id, array_keys($brandCount)))
                                                        <div class="flexed brand {{!empty($filter['brand']) && (in_array($item->id, $filter['brand'])) ? 'active' : ''}}" data-filter="{{$item->id}}" >
                                                            <i class="fa {{!empty($filter['brand']) && (in_array($item->id, $filter['brand'])) ? 'fa-check-square' : 'fa-square-o'}}" aria-hidden="true"></i>
                                                            <span>{{$item->name}} ({{$brandCount[$item->id]}})</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="box-list ">
                                    <div class="cat-list">
                                        <h4>
                                            Khoảng giá
                                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        </h4>
                                        <div class="list-body {{!empty($filter['price']) ? '' : 'hidden'}}">
                                            @foreach($priceFilterList as $item)
                                                <div class="flexed price {{!empty($filter['price']) && (in_array($item['slug'], $filter['price'])) ? 'active' : ''}}" data-filter="{{$item['slug']}}" >
                                                    <i class="fa {{!empty($filter['price']) && (in_array($item['slug'], $filter['price'])) ? 'fa-check-square' : 'fa-square-o'}}" aria-hidden="true"></i>
                                                    <span>{{$item['name']}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="right-content">
                    <div class="main-product">
                        <div class="list-product workstation-product grid-two-on-mobile">
                            @if(count($result) > 0)
                                @foreach($result as $item)
                                    <div class="product-item" data-id="{{$item->id}}">
                                        <a href="{{$item->getDetailLink()}}">
                                            <div class="image">
                                                <img src="{{$item->getImage(426, 320)}}" />
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
                                <div style="padding:60px 0;">
                                <p class="text-center">Không tìm thấy sản phẩm.</p>
								</div>
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
            /*--Fix top menu--*/
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if ($(".right-content").height() > 500) {
                    if(scroll > 500){
                        $("#main-menu").removeClass("open");
                        $(".active-left-content").addClass('fixtop');
                        $(".left-content-cate").addClass('fixtop');

                    }else{
                        // $(".active-left-content").removeClass('fixtop');
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
                    $menu_cate.removeClass("open");
                }else{
                    $menu_cate.addClass("open clicked");
                }
            });
            
            $(".filter-content h4 ").click(function () {
                var $filter_content =  $(this);
                var $parent = $filter_content.parent().children("div");
                if($parent.hasClass("hidden")){
                    $parent.removeClass("hidden");
                }else{
                    $parent.addClass("hidden");
                }
                if ($parent.height() > 350 ) {
                    $(".filter-content").css({"height":"350px","overflow-y":"scroll", "margin-bottom": "20px"})
                    console.log(1);
                }
                else {
                   console.log(2);
                }
            });

             $("#search-filters").click(function(e){
                e.preventDefault();
                $('.product-category').addClass("active");
            });
        })
    </script>

@endsection

@push('bottom')
    <script>
        function serialize(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + obj[p].join(','));
                }
            return str.join("&");
        }
        function applyFilter() {
            var filters = {category: [], brand: [], price: []};
            $("#boxFilter li .flex.category.active").each(function() {
                filters['category'].push($(this).data('filter'));
            });
          $("#boxFilter li .flex.brand.active").each(function() {
            filters['brand'].push($(this).data('filter'));
          });
            $("#boxFilter li .flex.price.active").each(function() {
                filters['price'].push($(this).data('filter'));
            });
            var url = $("#boxFilter").data('url');
            if(filters) {
                url += '&'+serialize(filters);
            }
            window.location = url;
        }
        function applyFilterPC() {
          var filters = {category: [], brand: [], price: []};
            $("#boxFilterPC div .flexed.category.active").each(function() {
                filters['category'].push($(this).data('filter'));
            });
          $("#boxFilterPC div .flexed.price.active").each(function() {
            filters['price'].push($(this).data('filter'));
          });
          $("#boxFilterPC div .flexed.brand.active").each(function() {
            filters['brand'].push($(this).data('filter'));
          });
            var url = $("#boxFilterPC").data('url');
            if(filters) {
                url += '&'+serialize(filters);
            }
            window.location = url;
        }
        $(document).ready(function () {
            $(".block-filter .head").click(function(){
                $(this).parent().toggleClass("active");
            });
            $("#boxFilter li .flex").click(function() {
                $(this).toggleClass('active');
            });
            $("#btnFilterSubmit").click(function() {
                applyFilter();
            });
            $("#boxFilterPC .box-list .flexed").click(function() {
                $(this).toggleClass('active');
                applyFilterPC();
            });
        })
    </script>
@endpush
