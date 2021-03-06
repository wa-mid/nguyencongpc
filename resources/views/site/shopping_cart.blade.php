@extends('layout.layout')

@section('content')
<div id="content">
    <div class="container">
        <div class="shopping-cart-page main-content">
            <div class="left-content-cate left only-mobile">
                @include('layout.menu')
            </div>
            <div class="left-content">

                <div class="box-shopping-cart">
                    <div class="list-product container">
                        @if($result->isNotEmpty())
                            @foreach($result as $item)
                                <div class="product-selected row mgy10">
                                    <div class="col-md-2 col-3 pdx5">
                                        <a href="{{$item->getDetailLink()}}"><img class="bp-product-image" src="{{$item->getImage(426, 320)}}" alt="{{$item->name}}"></a>
                                    </div>
                                    <div class="col-md-4 col-9 product-info pdx5">
                                        <p class="name font-weight-bold"><a href="{{$item->getDetailLink()}}">{{$item->name}}</a></p>
                                        <p class="price price font-weight-bold">{{Helper::formatMoney($item->getPriceLabel())}}</p>
                                    </div>
                                    <div class="col-md-2 col-4 quantity">
                                        <div class="number">
                                            <i class="fa fa-minus" onclick="minusProductQuantity(this, {{$item->id}})"></i>
                                            <input type="text" min="1" step="1" onchange="updateQuantity(this, {{$item->id}})" value="{{$item->quantity}}">
                                            <i class="fa fa-plus" onclick="addProductQuantity(this, {{$item->id}})"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-2 final-price for-pc">
                                        <span class="price font-weight-bold" id="total-price-buil ">{{$item->total>0 ? Helper::formatMoney($item->total) : 'Li??n h???'}}</span>
                                    </div>
                                    <div class="col-md-2 remove">
                                        <p class="btn btn-delete text-center text-uppercase" onclick="removeProduct({{$item->id}})">X??a</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Kh??ng t??m th???y s???n ph???m.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End left content-->
            <div class="right-content">
                <div class="box-shopping-cart">
                    @if($result->isNotEmpty())
                        <div class="box-pay pd10">
                      <!--       <div class="block-card">
                                T???m t??nh:
                                <span id="">{{Helper::formatMoney($result->sum('total'))}}</span>
                            </div> -->
                   <!--          <div class="block-card">
                                Ph?? v???n chuy???n:
                                <span id="">0??</span>
                            </div> -->
                            <!-- <i>Mi???n ph?? v???n chuy???n cho c??c ????n h??ng tr??n 1.000.000??</i> -->
                            <div class="block-card">
                                T???ng ti???n:
                                <span id="">{{Helper::formatMoney($result->sum('total'))}} <!-- <br><i>(???? bao g???m VAT)</i> --></span>
                            </div>
                            <button class="btn btn-danger btn-block"  data-toggle="modal" data-target="#modal-customer">?????t h??ng</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('bottom')
    <!-- The Modal -->
    <div class="modal" id="modal-customer">
        <div class="modal-dialog">
            <div class="modal-content" style="position: relative">
                <div class="loading" style="display: none;position:absolute;top:0;right:0;bottom:0;left:0;padding-top:30%;text-align: center;background: rgba(0,0,0,0.3)">
                    <img src="/img/ajax-loader-new.gif">
                </div>
                <form action="{{url('/gio-hang')}}" id="form-buy" method="post" enctype="multipart/form-data">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Th??ng tin mua h??ng</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="messages"></div>
                        @csrf
                        <input type="hidden" name="action" value="buy">
                        <div class="form-group">
                            <label for="input_name">H??? v?? t??n</label>
                            <input type="text" class="form-control" id="input_name" value="{{Auth::user() ? Auth::user()->name : ''}}" required name="name" placeholder="H??? v?? t??n">
                        </div>
                        <div class="form-group">
                            <label for="input_phone">S??? ??i???n tho???i</label>
                            <input type="text" class="form-control" value="{{Auth::user() ? Auth::user()->phone : ''}}"  id="input_phone" required name="phone" placeholder="S??? ??i???n tho???i">
                        </div>
                        <div class="form-group">
                            <label for="input_address">?????a ch???</label>
                            <input type="text" class="form-control" value="{{Auth::user() ? Auth::user()->address : ''}}"  id="input_address"  name="address" placeholder="?????a ch??? nh???n h??ng">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">????ng</button>
                        <button type="submit" class="btn btn-primary">Mua h??ng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Th??ng b??o</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p class="text-center">????n h??ng c???a qu?? kh??ch ???? ???????c g???i th??nh c??ng. NGUYENCONGPC s??? li??n h??? l???i v???i qu?? kh??ch ????? s???m nh???t. </br>C???m ??n qu?? kh??ch !</p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">????ng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function removeProduct(product_id) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/gio-hang',
                data: {
                    action: "removeproduct",
                    product_id: product_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                context: this,
                beforeSend: function() {

                },
                success: function(response) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
        }
        function clearAll(val){
            $.ajax({
                type : "POST",
                dataType : "json",
                url : '/gio-hang',
                data : {
                    action: "clearall",
                },
                context: this,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){

                },
                success: function(response) {
                    location.reload();
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    //L??m g?? ???? khi c?? l???i x???y ra
                    console.log( 'The following error occured: ' + textStatus, errorThrown );
                }
            });
        }
        function updateProductQuantity(product_id, quantity) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/gio-hang',
                data: {
                    action: "updateproductquantity",
                    product_id: product_id,
                    quantity: quantity,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                context: this,
                beforeSend: function() {
                },
                success: function(response) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('The following error occured: ' + textStatus, errorThrown);
                }
            });
        }
        function updateQuantity(input, product_id) {
            if(input) {
                var quantity = parseInt($(input).val());
                updateProductQuantity(product_id, quantity);
            }
        }
        function addProductQuantity(val, product_id) {
            var input = $(val).prev('input');
            if(input) {
                var quantity = parseInt(input.val()) + 1;
                input.val(quantity);
                updateProductQuantity(product_id, quantity);
            }
        }
        function minusProductQuantity(val, product_id) {
            var input = $(val).next('input');
            if(input && input.val() > 1) {
                var quantity = parseInt(input.val()) - 1;
                input.val(quantity);
                updateProductQuantity(product_id, quantity);
            }
        }
        $(document).ready(function(){
            $('#form-buy').on('submit', function(e) {
                e.preventDefault()
                $('.btn-primary').attr("disabled", 'disabled')
                $('.loading').css({"display" : "block" , "position" :"absolute", "top": "0", "right":"0", "bottom":"0","left" : "0" ,"padding-top" : "30%" , "text-align" : "center", "background" : "rgba(0,0,0,0.3)", "z-index" : "9"});
                var url = "/gio-hang";
                // POST values in the background the the script URL
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $(this).serialize(),
                    success: function (data)
                    {
                        if(data.success) {
                            $('#modal-customer').modal('hide');
                            $('#modal-confirm').modal('show');
                        } else if(data.message) {
                            var alertBox = '<div class="alert alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.message + '</div>';
                            $('#form-buy').find('.messages').html(alertBox);
                        }
                    }
                });
                return false;
            });
            $('#modal-confirm').on('hide.bs.modal', function () {
                window.location = '/';
            })
        })
    </script>
@endpush
