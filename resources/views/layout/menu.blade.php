
<div id="main-menu" class="left left-content {{(Request::path() == "/" || Request::path() == "xay-dung-cau-hinh" || dirname(Request::path()) == "xay-dung-cau-hinh") ? 'menu-home open' : 'menu-cate' }}">
    <div class="head for-pc">
        <i class="fa fa-bars"></i>
        <span>Danh mục sản phẩm</span>
    </div>

    <div class="head only-mobile" id="btn-back-menu">
        <i class="fa fa-arrow-left"></i>
        <span>Quay lại</span>
    </div>
    <ul>
        @foreach(Helper::getProductCategories() as $rootItem)
            @if($rootItem['is_menu'] == 1)
            <li class="menu-item">
                <a href="{{route('detail_page', $rootItem['slug'])}}">
                    <i class="icon icon-{{$rootItem['slug']}}"></i>
                    <span>{{$rootItem['name']}}</span>
                </a>
                @if(!empty($rootItem['child']))
                    <div class="only-mobile expand-menu">
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div class="submenu lv1">
                        <div class="head for-pc">
                            <p>{{$rootItem['name']}}</p>
                        </div>
                        <div class="content">
                            <div class="box-menu-item">
                                <ul>
                                    @foreach($rootItem['child'] as $childItem)
                                    <li>
                                        @if(!empty($childItem['child']))
                                            <a href="{{route('categorySub', ['rootUri' => $rootItem['slug'], 'uri' => $childItem['slug']])}}" class="call-22">
                                                {{$childItem['name']}}
                                            </a>
                                            <div class="submenu lv2">
                                                <ul>
                                                    @foreach($childItem['child'] as $item)
                                                        <li>
                                                            <a href="{{route('categorySub', ['rootUri' => $rootItem['slug'], 'uri' => $item['slug']])}}"><i class="fa fa-angle-right"></i>{{$item['name']}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <a href="{{route('categorySub', ['rootUri' => $rootItem['slug'], 'uri' => $childItem['slug']])}}">
                                                {{$childItem['name']}}
                                            </a>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="list-product clearfix for-pc">
                                @foreach(Helper::getMenuProductsByCategory($rootItem['id'], 4) as $item)
                                    <div class="product-item">
                                        <a href="{{$item->getDetailLink()}}">
                                            <div class="image">
                                                <img src="{{$item->getImage(200, 150)}}" alt="{{$item->name}}">
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
                @endif
            </li>
            @endif
        @endforeach
        <li>
            <a href="/tin-tuc">
                <i class="icon icon-s12"></i>
                <span>TIN TỨC</span>
            </a>
        </li>
    </ul>
</div>
<!-- End Menu -->

