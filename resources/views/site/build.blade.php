@extends('layout.layout')

@section('content')
    <div id="content">
        <div class="container">
            @include('layout.menu')
            <div class="main-content">
                <div class="right-content">
                    <div class="breadcrumb">
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
                                <strong>Xây dựng cấu hình</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="block block-build-config" id="build-config">
                        <div class="head">
                            <h1 style="font-size: 16px;padding: 2px 5px; text-transform: uppercase;font-weight: bold">Xây dựng cấu hình </h1>
                        </div>

                        <div class="content box-config">
                            <div class="header">
                                <ul class="list-btn-action list-btn-action-new ">
                                    <li class="{{$profile == 'ch-1' ? 'active' : ''}}"><a href="/xay-dung-cau-hinh/ch-1">Cấu hình 1</a></li>
                                    <li class="{{$profile == 'ch-2' ? 'active' : ''}}"><a href="/xay-dung-cau-hinh/ch-2">Cấu hình 2</a></li>
                                    <li class="{{$profile == 'ch-3' ? 'active' : ''}}"><a href="/xay-dung-cau-hinh/ch-3">Cấu hình 3</a></li>
                                    <li class="{{$profile == 'ch-4' ? 'active' : ''}}"><a href="/xay-dung-cau-hinh/ch-4">Cấu hình 4</a></li>
                                    <li class="{{$profile == 'ch-5' ? 'active' : ''}}"><a href="/xay-dung-cau-hinh/ch-5">Cấu hình 5</a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <table class="table">
                                    <thead>
                                    <tr class="row">
                                        <th class="col-md-2 col-4 font-weight-bold">Xây Dựng</th>
                                        <th class="col-md-10 col-8" >
                                            <input name="profile" id="txt-profile" value="{{$profile}}" type="hidden">
                                            <span class="btn-rebuild mgr10 pd10" onclick="clearAll(this)">Build lại</span>
                                            <label>Chi phí: </label>
                                            <span class="price display-8" id="total-price-buil">{{ isset($saveBuildPc) ? Helper::formatMoney($saveBuildPc->total) : '0 đ'}}</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buildCategories as $index => $category)
                                        <tr class="row" id="category_{{$category->id}}" data-cat-id="{{$category->id}}">
                                            <td class="col-md-2 col-4 font-weight-bold">{{$index+1}}. {{$category->name}}</td>
                                            <td class="col-md-10 col-8 bp-table-value">
                                                @if(isset($listProducts[$category->id]))
                                                    <?php $product = $listProducts[$category->id] ?>
                                                    <div class="product-selected row">
                                                        <div class="col-md-2 col-3 pdx5">
                                                            <img class="bp-product-image" src="{{Helper::getThumbnail($product->image, 426, 320)}}" title="{{$product->name}}">
                                                        </div>
                                                        <div class="col-md-4 col-9 product-info pdx5">
                                                            <p class="name font-weight-bold"><a target="_blank" href="/{{$product->slug}}">{{$product->name}}</a></p>
                                                            <p class="price price font-weight-bold">{{($product->getPrice() > 0) ? Helper::formatMoney($product->getPrice()) : 'Liên hệ'}}</p>
                                                        </div>
                                                        <div class="col-md-2 col-4 quantity">
                                                            <div class="number">
                                                                <i class="fa fa-minus" onclick="minusProductQuantity(this, {{$category->id}}, {{$product->id}})"></i>
                                                                <input type="text" min="1" step="1" value="{{$product->quantity}}" onkeyup="keyupProductQuantity(event, this, {{$category->id}}, {{$product->id}})">
                                                                <i class="fa fa-plus" onclick="addProductQuantity(this, {{$category->id}}, {{$product->id}})"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 final-price for-pc">
                                                            <span class="price font-weight-bold" id="total-price-buil ">{{($product->total > 0) ? Helper::formatMoney($product->total) : 'Liên hệ'}}</span>
                                                        </div>
                                                        <div class="col-md-2 remove">
                                                            <p class="btn btn-reselect text-center text-uppercase mgy10" onclick="openModal(this)" data-cat-id="{{$category->id}}">Chọn lại</p>
                                                            <p class="btn btn-delete text-center text-uppercase" onclick="removeProduct({{$category->id}}, {{$product->id}})">Xóa</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="btn btn-select-device text-uppercase text-center btn-modal" onclick="openModal(this)" data-cat-id="{{$category->id}}">Chọn {{$category->name}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mb-20">
                                    <div class="money pull-left">
                                        <label>Chi phí: </label>
                                        <span id="total-price-buil-bootom" class="price">{{ isset($saveBuildPc) ? Helper::formatMoney($saveBuildPc->total) : '0 đ'}}</span>
                                    </div>
                                    <div class="pull-right end-build-conf mgy10">
                                        <div class="button-group">
                                            <a href="/export-cau-hinh-excel/{{$profile}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-excel-o"></i>
                                                <span>Tải excel</span>
                                            </a>
                                            <a href="/export-cau-hinh-image/{{$profile}}" class="btn btn-info btn-sm">
                                                <i class="fa fa-picture-o"></i>
                                                <span>Tải ảnh</span>
                                            </a>
                                            <a href="/in-cau-hinh/{{$profile}}" class="btn btn-secondary btn-sm for-pc">
                                                <i class="fa fa-print"></i>
                                                <span>In cấu hình</span>
                                            </a>
                                            <button class="btn btn-success btn-sm btn-add-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Giỏ hàng</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade modal-build" id="modal-filter" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title text-uppercase font-weight-bold">Chọn linh kiện</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="mgx15">
                                <div class="modal-body row">
                                    <div id="buildpc_loading" class="bp-loading hidden"><img src="/img/ajax-loader-new.gif" title="Đang tải"></div>
                                    <div class="left menu-device col-md-4">
                                        <div class="block block-filter">

                                        </div>
                                    </div>
                                    <div class="left list-device col-md-8">
                                        <div class="search-device">
                                            <div class="input pd5">
                                                <input type="text" id="bp-search-input" placeholder="Bạn cần tìm linh kiện gì ?">
                                                <div class="icon" id="bp-search-button" style="cursor: pointer;">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="list-device-pagination"></div>
                                        <div class="mgx15 list-device-result container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="/js/dom-to-image.min.js"></script>

                <script>
                    var filterModal;
                    function addToBuildPC(val){
                        $("#modal-filter").modal('hide');
                        var cat_id = $(val).attr('data-cat-id');
                        var profile = $("#txt-profile").val();
                        var product_name = $(val).attr('data-product-name');
                        var product_id = $(val).attr('data-product-id');
                        var product_price = $(val).attr('data-product-price');
                        var product_url = $(val).attr('data-product-url');
                        var product_image = $(val).attr('data-product-image-url');
                        $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : '/filter-ajax',
                            data : {
                                action: "addtobuildpc",
                                category_id : cat_id,
                                profile : profile,
                                product_name : product_name,
                                product_id : product_id,
                                product_price : product_price,
                                product_url : product_url,
                                product_image : product_image,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            context: this,
                            success: function(response) {
                                $('#buildpc_loading').addClass('hidden');

                                $('#category_'+cat_id+' .bp-table-value').html(response.html);
                                $('#total-price-buil').html(response.total);
                                $('#total-price-buil-bootom').html(response.total);
                                
                            },
                            error: function( jqXHR, textStatus, errorThrown ){
                                //Làm gì đó khi có lỗi xảy ra
                                console.log( 'The following error occured: ' + textStatus, errorThrown );
                            }
                        });
                    }
                    function openModal(val) {
                        var category_id = $(val).attr('data-cat-id');
                        $("#modal-filter").data('category_id', category_id);
                        $('#bp-search-input').val("");
                        loadModalContent(1, []);
                    }
                    function serialize(obj) {
                        var str = [];
                        for (var p in obj)
                            if (obj.hasOwnProperty(p)) {
                                str.push(encodeURIComponent(p) + "=" + obj[p].join(','));
                            }
                        return str.join("&");
                    }
                    function expandLeftFilter() {
                        var activeItems = $('#modal-filter .block-filter .filter-item.active');
                        if(activeItems.length > 0) {
                            activeItems.each(function() {
                                $(this).closest('li').addClass('active');
                            });
                        } else {
                            $('#modal-filter .block-filter li:first-child').addClass('active');
                        }
                    }
                    var loadRequest;
                    function loadModalContent(page, filters, sort = "") {
                        var category_id = $("#modal-filter").data('category_id');
                        var name = $('#bp-search-input').val();
                        if(loadRequest && loadRequest.readyState != 4){
                            loadRequest.abort();
                        }
                        loadRequest = $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : '/filter-ajax',
                            data : {
                                action: "popupbuildpc",
                                category_id : category_id,
                                page : page,
                                name : name,
                                sort : sort,
                                filters: serialize(filters)
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            context: this,
                            beforeSend: function() {
                                filterModal = $("#modal-filter").modal('show');
                                $('#buildpc_loading').removeClass('hidden');
                            },
                            success: function(response) {
                                $('#buildpc_loading').addClass('hidden');
                                $('#modal-filter .block-filter').html(response.html_left);
                                $('#modal-filter .list-device-result').html(response.html_right);
                                $('#list-device-pagination').html(response.html_page);
                                expandLeftFilter();
                            },
                            error: function( jqXHR, textStatus, errorThrown ){
                                //Làm gì đó khi có lỗi xảy ra
                                console.log( 'The following error occured: ' + textStatus, errorThrown );
                            }
                        });
                    }
                    function removeProduct(category_id, product_id) {
                        var profile = $("#txt-profile").val();
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: '/filter-ajax',
                            data: {
                                action: "removeproduct",
                                category_id: category_id,
                                product_id: product_id,
                                profile: profile
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
                        var profile = $("#txt-profile").val();
                        $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : '/filter-ajax',
                            data : {
                                action: "clearalltobuildpc",
                                profile: profile
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
                                //Làm gì đó khi có lỗi xảy ra
                                console.log( 'The following error occured: ' + textStatus, errorThrown );
                            }
                        });
                    }
                    function updateProductQuantity(category_id, product_id, quantity) {
                        var profile = $("#txt-profile").val();
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: '/filter-ajax',
                            data: {
                                action: "updateproductquantity",
                                category_id: category_id,
                                product_id: product_id,
                                quantity: quantity,
                                profile: profile
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
                    function addToCart() {
                      var profile = $("#txt-profile").val();
                      $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: '/filter-ajax',
                        data: {
                          action: "addtocart",
                          profile: profile
                        },
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        context: this,
                        beforeSend: function() {

                        },
                        success: function(response) {
                          if(response.success) {
                            window.location = response.url;
                          } else {
                            console.log(response.message);
                          }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                          console.log('The following error occured: ' + textStatus, errorThrown);
                        }
                      });
                    }
					var updateProductTimer = null;
                    function addProductQuantity(val, category_id, product_id) {
                        var input = $(val).prev('input');
                        if(input) {
                            var quantity = parseInt(input.val()) + 1;
                            input.val(quantity);
							updateProductTimer && clearTimeout(updateProductTimer);
							updateProductTimer = setTimeout(function () {
                                updateProductQuantity(category_id, product_id, quantity);
                            }, 1000); 
                        }
                    }
                    var timer;
                    function keyupProductQuantity(event, input, category_id, product_id) {
                        var keycode = (event.keyCode ? event.keyCode : event.which);
                        var quantity = parseInt($(input).val());
                        if(keycode == 13) {
							timer && clearTimeout(timer);
                            updateProductQuantity(category_id, product_id, quantity);
                        } else {
                            timer && clearTimeout(timer);
                            timer = setTimeout(function () {
                                updateProductQuantity(category_id, product_id, quantity);
                            }, 1000);
                        }
                    }
                    function minusProductQuantity(val, category_id, product_id) {
                        var input = $(val).next('input');
                        if(input && input.val() > 1) {
                            var quantity = parseInt(input.val()) - 1;
                            input.val(quantity);
							updateProductTimer && clearTimeout(updateProductTimer);
							updateProductTimer = setTimeout(function () {
                                updateProductQuantity(category_id, product_id, quantity);
                            }, 1000);
                        }
                    }
                    function showProductFilterSort(sort) {
                      var filters = [];
                      $("#modal-filter .block-filter .filter-item.active").each(function() {
                        var category = $(this).closest('li').data('category');
                        if(filters[category]) {
                          filters[category].push($(this).data('filter'));
                        } else {
                          filters[category] = [];
                          filters[category].push($(this).data('filter'));
                        }
                      });
                      loadModalContent(1, filters, sort);
                    } 
                    function exportToImage() {
                        $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : '/filter-ajax',
                            data : {
                                action: "exprortimagebuildpc"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            context: this,
                            beforeSend: function(){
                                //$('#buildpc_loading').removeClass('hidden');
                            },
                            success: function(response) {
                                var html_text = document.createElement('div');
                                html_text.innerHTML =  response.html;
                                document.body.appendChild(html_text);

                                var node = document.getElementById('exportImg');
                                domtoimage.toPng(node)
                                    .then(function (dataUrl) {
                                        var link = document.createElement('a');
                                        link.download = 'buildpc_nguyencongpc.png';
                                        link.href = dataUrl;
                                        link.click();
                                    })
                                    .catch(function (error) {
                                        console.error('oops, something went wrong!', error);
                                    });
                            },
                            error: function( jqXHR, textStatus, errorThrown ){
                                //Làm gì đó khi có lỗi xảy ra
                                console.log( 'The following error occured: ' + textStatus, errorThrown );
                            }
                        });

                        setTimeout(function(){
                            location.reload();
                        },5000); //delay is in milliseconds
                    }
                    $(document).ready(function(){
                        $( "#modal-filter" ).on( "click", "div.head", function() {
                            $(this).closest('li').toggleClass('active');
                        });

                        $('#modal-filter .block-filter').slimScroll({
                            height: '530px'
                        });
                        $('#modal-filter .list-device-result').slimScroll({
                            height: '486px'
                        });
                        $( "#modal-filter .block-filter" ).on( "click", ".filter-item", function() {
                            $(this).toggleClass('active');
                            var filters = [];
                            $("#modal-filter .block-filter .filter-item.active").each(function() {
                                var category = $(this).closest('li').data('category');
                                if(filters[category]) {
                                    filters[category].push($(this).data('filter'));
                                } else {
                                    filters[category] = [];
                                    filters[category].push($(this).data('filter'));
                                }
                            });
                            loadModalContent(1, filters);
                        });
                        $( "#list-device-pagination").on( "click", "a.page-link", function() {
                            var page = $(this).data("page");
                            var filters = [];
                            $("#modal-filter .block-filter .filter-item.active").each(function() {
                                var category = $(this).closest('li').data('category');
                                if(filters[category]) {
                                    filters[category].push($(this).data('filter'));
                                } else {
                                    filters[category] = [];
                                    filters[category].push($(this).data('filter'));
                                }
                            });
                            loadModalContent(page, filters);
                        });

                        $('#bp-search-button').click(function() {
                            var filters = [];
                            $("#modal-filter .block-filter .filter-item.active").each(function() {
                                var category = $(this).closest('li').data('category');
                                if(filters[category]) {
                                    filters[category].push($(this).data('filter'));
                                } else {
                                    filters[category] = [];
                                    filters[category].push($(this).data('filter'));
                                }
                            });
                            loadModalContent(1, filters);
                        });
						$("#bp-search-input").on('keyup', function (e) {
							if (e.keyCode === 13) {
								var filters = [];
								$("#modal-filter .block-filter .filter-item.active").each(function() {
									var category = $(this).closest('li').data('category');
									if(filters[category]) {
										filters[category].push($(this).data('filter'));
									} else {
										filters[category] = [];
										filters[category].push($(this).data('filter'));
									}
								});
								loadModalContent(1, filters);
							}
						});
                        $(".btn-add-cart").click(function() {
                            addToCart();
                        });
                        $(".btn-buy-now").click(function() {
                            addToCart();
                        });
                    })
                </script>
            </div>
        </div>

    </div>
@endsection
