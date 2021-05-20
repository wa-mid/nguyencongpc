@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$product->id ? 'Edit Product' : 'New Product'}} &nbsp;&nbsp;
                <a href="{{route("admin.products.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Product</a>
                @if($product->id)
                    <a href="{{route("admin.products.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Product</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($product, ['method' => 'POST','route' => $product->id ? ['admin.products.edit', $product->id] : 'admin.products.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Product</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Other</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
						@if($product->slug)
                        <a href="{{ $product->getDetailLink() }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Preview</a>
						@endif
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Tên sản phẩm</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Danh mục</strong>
                                    {!! $allCategories->placeholder(0, '--Chọn Danh mục--')->renderAsMultiple() !!}
                                </div>
                                <div class="form-group">
                                    <strong>Cấu hình</strong>
                                    {!! $allFilter->placeholder(0, '--Chọn bộ lọc--')->renderAsMultipleExt() !!}
                                </div>
                                <div class="form-group">
                                    <strong>Thông số kỹ thuật</strong>
                                    {!! Form::textarea('profile', null, array('placeholder' => 'Thông số kỹ thuật','class' => 'form-control', 'id' => 'product-profile')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Video</strong>
                                    {!! Form::textarea('video', null, array('placeholder' => 'Video','class' => 'form-control','rows' => 4)) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Nhãn hàng</strong>
                                    {!! $allBrands->placeholder(0, '--Brand--')->renderAsDropdown() !!}
                                </div>
                                <div class="form-group">
                                    <strong>Mô tả sản phẩm</strong>
                                    {!! Form::textarea('content', null, array('placeholder' => 'Content','class' => 'form-control', 'id' => 'product-content')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <strong>Mã hàng</strong>
                                    {!! Form::text('code', null, array('placeholder' => 'Mã hàng','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Bảo hành</strong>
                                    {!! Form::text('warranty', null, array('placeholder' => 'Bảo hành','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('status', array( '1' => 'Còn hàng', '2' => 'Hết hàng', '0' => 'Ngừng kinh doanh'), $product->status, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Số lượng</strong>
                                    {!! Form::text('amount', null, array('placeholder' => 'Số lượng','class' => 'form-control ip-number')) !!}
                                </div>
								
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <strong>Giá bán thường</strong>
                                    {!! Form::text('regular_price', null, array('placeholder' => 'Giá bán thường','class' => 'form-control ip-number')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Giá khuyến mãi</strong>
                                    {!! Form::text('price', null, array('placeholder' => 'Giá khuyến mãi','class' => 'form-control ip-number')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Khuyến mại</strong>
                                    {!! Form::text('promotion', null, array('placeholder' => 'Khuyến mại','class' => 'form-control')) !!}
                                </div>
								<div class="form-group">
                                    <strong>Ẩn sản phẩm</strong>
                                    {!! Form::select('is_delete', array( '0' => 'Không ẩn', '1' => 'Ẩn sản phẩm'), $product->is_delete, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Ảnh chính</strong>
                                    <div class="field-image">
                                        <div class="input-group">
                                            <a id="image_upload_btn" data-input="image_input" data-preview="image_preview" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh
                                            </a>
                                            <input id="image_input" class="form-control" value="{{$product->image}}" type="hidden" name="image">
                                        </div>
                                        <div class="pimage">
                                            <img id="image_preview" style="max-width:150px;height: 100px;min-width: 50px;margin-right:0;" src="{{asset($product->image)}}">
                                            <a class="remove" href="#"><i class="fa fa-times"></i></a>
                                        </div>
                                        <input type="hidden" id="image_removed" name="image_removed" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <strong>Ảnh thư viện</strong>
                                    <div class="images-field" id="product-images">
                                        <ul class="ul-images">
                                            @if(!empty($product->getRealImages()))
                                                @foreach($product->getRealImages() as $image)
                                                    <li>
                                                        <input type="hidden" name="images[]" value="{{$image}}">
                                                        <img src="{{asset($image)}}">
                                                        <a class="remove" href="#"><i class="fa fa-times"></i></a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <div class="buttons">
                                            <a id="images_upload_btn" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Thư viện
                                            </a> hoặc
                                            <input type="file" id="upload_images" name="upload_images[]" multiple/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Slug</strong>
                                    {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                                </div>
								<div class="form-group">
                                    <label>Publish Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="published_at" value="{{$product->published_at ? Helper::formatDateFromString($product->published_at, 'd/m/Y') : date('d/m/Y')}}" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <strong>Meta title</strong>
                                    {!! Form::text('meta_title', null, array('placeholder' => 'Meta title','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Meta Desc</strong>
                                    {!! Form::textarea('meta_desc', null, array('placeholder' => 'Meta Desc', 'rows' => 5, 'class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Meta Keywords</strong>
                                    {!! Form::textarea('meta_keywords', null, array('placeholder' => 'Meta Keywords', 'rows' => 5,'class' => 'form-control')) !!}
                                </div>
								<div class="form-group">
                                    <strong>Meta Pixel</strong>
                                    {!! Form::textarea('meta_pixel', null, array('placeholder' => 'Meta Pixel','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" {{$product->is_device ? 'checked' : ''}} value="1" name="is_device">
                                            Là Linh Kiện?
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <strong>Thuộc tính</strong>
                                    @foreach($allAttributes as $key => $att)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" {{$product->haveAttribute($key) ? 'checked' : ''}} value="{{$key}}" name="attributes[]">
                                                {{$att}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <strong>Keywords</strong>
                                    {!! Form::textarea('keywords', null, array('placeholder' => 'Keywords','rows' => 5,'class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Điểm</strong>
                                    {!! Form::number('score', null, array('placeholder' => 'Điểm','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Số lượng bình chọn</strong>
                                    {!! Form::number('total_rate', null, array('placeholder' => 'Số lượng bình chọn','class' => 'form-control')) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script src="/adminlte/ckeditor/ckeditor.js?v=4.14"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="/adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/adminlte/jquery.number/jquery.number.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/select2/select2.full.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $(function () {
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&responseType=json&_token={{ csrf_token() }}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&responseType=json&_token={{ csrf_token() }}'
            };

            CKEDITOR.replace('product-profile', options);
            CKEDITOR.replace('product-content', options);
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy'
            });
            $(".ip-number").number(true, 0);
            $("#product-images ul").sortable();
            $("#product-images").on('click','a.remove', function(e) {
                e.preventDefault();
                $(this).closest('li').remove();
            });
            $(".pimage a.remove").on('click', function(e) {
                e.preventDefault();
                $("#image_removed").val("1");
                $("#image_preview").attr("src", "");
            });
            //$("ul.ul-images").sortable();
            $("#upload_images").on('change', function () {
                var images = $('#upload_images')[0];
                var data = new FormData();
                if(images.files.length > 0) {
                    for (let i = 0; i < images.files.length; i++) {
                        data.append('files['+i+']', images.files[i]);
                    }
                    $.ajax({
                        url: '/admin/products/upload-images',
                        type: 'post',
                        data: data,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response && response.length > 0){
                                response.forEach(function (file) {
                                    var li = '<li><input type="hidden" name="images[]" value="'+file+'"><img src="'+file+'"><a class="remove" href="#"><i class="fa fa-times"></i></a></li>';
                                    $("#product-images ul").append(li);
                                });
                            } else {
                                showMessage('file not uploaded', 'alert');
                            }
                            $('#upload_images').val('');
                        },
                    });
                }
            });
            $('.select2').select2()
            $('#image_upload_btn').filemanager('image');
            $('#images_upload_btn').filesmanager('image');
        })

    </script>
@endpush
