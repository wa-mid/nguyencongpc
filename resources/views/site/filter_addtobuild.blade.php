@if(!empty($product))
    <div class="product-selected row">
        <div class="col-md-2 col-3 pdx5">
            <img class="bp-product-image" src="{{$product->getImage(426, 320)}}" title="{{$product->name}}">
        </div>
        <div class="col-md-4 col-9 product-info pdx5">
            <p class="name font-weight-bold"><a href="/{{$product->slug}}">{{$product->name}}</a></p>
            <p class="price price font-weight-bold">{{Helper::formatMoney($product->getPriceLabel())}}</p>
        </div>
        <div class="col-md-2 col-4 quantity">
            <div class="number">
                <i class="fa fa-minus" onclick="minusProductQuantity(this, {{$categoryId}}, {{$product->id}})"></i>
                <input type="text" min="1" step="1" value="{{$saveBuildPcProduct->quantity}}">
                <i class="fa fa-plus" onclick="addProductQuantity(this, {{$categoryId}}, {{$product->id}})"></i>
            </div>
        </div>
        <div class="col-md-2 final-price for-pc">
            <span class="price font-weight-bold" id="total-price-buil ">{{($saveBuildPcProduct->total > 0) ? Helper::formatMoney($saveBuildPcProduct->total) : 'Liên hệ'}}</span>
        </div>
        <div class="col-md-2 remove">
            <p class="btn btn-reselect text-center text-uppercase mgy10" onclick="openModal(this)" data-cat-id="{{$categoryId}}">Chọn lại</p>
            <p class="btn btn-delete text-center text-uppercase" onclick="removeProduct({{$categoryId}}, {{$saveBuildPcProduct->product_id}})">Xóa</p>
        </div>
    </div>
@endif
