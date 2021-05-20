@if(!empty($products) && !$products->isEmpty())
    @foreach($products as $item)
        <div class="row">
            <div class="col-md-2 col-2">
                <img class="bp-product-image" src="{{$item->getImage(426, 320)}}" title="{{$item->name}}">
            </div>
            <div class="col-md-8 col-8 product-info pdx5">
                <p class="name font-weight-bold"><a target="_blank" href="{{$item->getDetailLink()}}">{{$item->name}}</a></p>
                <p class="price price font-weight-bold">{{Helper::formatMoney($item->getPriceLabel())}}</p>
            </div>
            <div class="col-md-2 col-2 ">
                @if($item->status == 1 || $item->status == 2)
                    <p class="btn btn-select text-center" onclick="addToBuildPC(this)" data-cat-id="{{$category_id}}" data-product-id="{{$item->id}}" data-product-name="{{$item->name}}" data-product-price="{{$item->getPrice()}}" data-product-url="{{$item->slug}}" data-product-image-url="{{$item->getImage(426, 320)}}">
                        <i class="fa fa-plus"></i>
                    </p>
                @else
                    <p class="btn btn-select disabled text-center">
                        <i class="fa fa-ban"></i>
                    </p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <p class="message text-center">Không tìm thấy sản phẩm.</p>
@endif
