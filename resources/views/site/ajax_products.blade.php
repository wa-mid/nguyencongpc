@if(!empty($products))
    @foreach($products as $item)
        <div class="product-item" data-id="{{$item->id}}">
            <a href="{{$item->getDetailLink()}}">
                <div class="image">
                    <img src="{{$item->getImage(426, 320)}}" />
                </div>
                <p class="text">
                    <span class="name">{{$item->name}}</span>
                    <span class="new-price">{{$item->getPrice() > 0 ? Helper::formatMoney($item->getPrice()) : "Liên hệ"}}</span>
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
@endif
