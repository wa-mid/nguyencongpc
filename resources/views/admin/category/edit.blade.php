@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$category->id ? 'Edit Category' : 'New Category'}} &nbsp;&nbsp;
                <a href="{{route("admin.categories.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Category</a>
                @if($category->id)
                    <a href="{{route("admin.categories.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Category</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($category, ['method' => 'POST','route' => $category->id ? ['admin.categories.edit', $category->id] : 'admin.categories.create', 'enctype' => "multipart/form-data"]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <strong>Name</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Slug</strong>
                                {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Chuyên mục cha</strong>
                                {!! $allCategories->placeholder(0, '--Chọn Chuyên mục cha--')->renderAsDropdown() !!}
                            </div>
                            <div class="form-group">
                                <strong>Chọn bộ lọc</strong>
                                {!! Form::select('filter_id', $allFilter, $category->filter_id, array('class' => 'form-control', 'placeholder' => 'Chọn bộ lọc')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Hiển thị trang Build sản phẩm (để trống hoặc 0 là không hiển thị)</strong>
                                {!! Form::number('build', null, array('placeholder' => 'Thứ tự','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Thứ tự trên menu</strong>
                                {!! Form::number('priority', null, array('placeholder' => 'Thứ tự','class' => 'form-control')) !!}
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('is_menu', 1, $category->is_menu == 1); !!} Hiển thị trên menu
                                </label>
                            </div>
                            <div class="form-group">
                                <strong>Tiêu đề</strong>
                                {!! Form::text('title', null, array('placeholder' => 'Tiêu đề','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Description</strong>
                                {!! Form::textarea('description', null, array('placeholder' => 'Mô tả','class' => 'form-control', 'rows' => 5)) !!}
                            </div>
                            <div class="form-group">
                                <strong>Keywords</strong>
                                {!! Form::textarea('keywords', null, array('placeholder' => 'Từ khóa','class' => 'form-control', 'rows' => 5)) !!}
                            </div>
                            <div class="form-group">
                                <strong>Ảnh chuyên mục</strong>
                                <div class="image-field">
                                    @if($category->image)
                                        <div class="pimage">
                                            <img style="max-width:150px;height: 50px;min-width: 50px" src="{{asset($category->image)}}">
                                            <a class="remove" href="#"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endif
                                    <input type="hidden" id="image_removed" name="image_removed" value="0">
                                    {!! Form::file('image', array('placeholder' => 'Image')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h3 class="box-title">Slide Ảnh Desktop</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="3"><input type="file" class="form-control" id="upload_images" name="upload_images[]" multiple/></td>
                                </tr>
                                </thead>
                                <tbody id="categoryImages">
                                    @foreach($category->getSlides() as $slide)
                                        @if(isset($slide->image))
                                        <tr><td><input type="hidden" name="images[]" value="{{$slide->image}}"><img src="{{$slide->image}}"></td><td style="width: 60%"><input placeholder="Link" value="{{isset($slide->link) ? $slide->link : ""}}" class="form-control" name="links[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <h3 class="box-title">Slide Ảnh Desktop 2</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="3"><input type="file" class="form-control" id="upload_images_2" name="upload_images_2[]" multiple/></td>
                                </tr>
                                </thead>
                                <tbody id="categoryImages_2">
                                @foreach($category->getSlides2() as $slide)
                                    @if(isset($slide->image))
                                        <tr><td><input type="hidden" name="images_2[]" value="{{$slide->image}}"><img src="{{$slide->image}}"></td><td style="width: 60%"><input placeholder="Link" value="{{isset($slide->link) ? $slide->link : ""}}" class="form-control" name="links_2[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
							<h3 class="box-title">Slide Ảnh Mobile</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="3"><input type="file" class="form-control" id="upload_mobile_images" name="upload_mobile_images[]" multiple/></td>
                                </tr>
                                </thead>
                                <tbody id="categoryMobileImages">
                                    @foreach($category->getMobileSlides() as $slide)
                                        @if(isset($slide->image))
                                        <tr><td><input type="hidden" name="mobile_images[]" value="{{$slide->image}}"><img src="{{$slide->image}}"></td><td style="width: 60%"><input placeholder="Link" value="{{isset($slide->link) ? $slide->link : ""}}" class="form-control" name="mobile_links[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                            <h3 class="box-title">Slide Ảnh Mobile 2</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="3"><input type="file" class="form-control" id="upload_mobile_images_2" name="upload_mobile_images_2[]" multiple/></td>
                                </tr>
                                </thead>
                                <tbody id="categoryMobileImages_2">
                                @foreach($category->getMobileSlides2() as $slide)
                                    @if(isset($slide->image))
                                        <tr><td><input type="hidden" name="mobile_images_2[]" value="{{$slide->image}}"><img src="{{$slide->image}}"></td><td style="width: 60%"><input placeholder="Link" value="{{isset($slide->link) ? $slide->link : ""}}" class="form-control" name="mobile_links_2[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $(".pimage a.remove").on('click', function(e) {
                e.preventDefault();
                $("#image_removed").val("1");
                $(".pimage").html("");
            });
            $( "#categoryImages" ).sortable();
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
                                    var tr = '<tr><td><input type="hidden" name="images[]" value="'+file+'"><img src="'+file+'"></td><td style="width: 60%"><input placeholder="Link" class="form-control" name="links[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>';
                                    $("#categoryImages").append(tr);
                                });
                            } else {
                                showMessage('file not uploaded', 'alert');
                            }
                            $('#upload_images').val('');
                        },
                    });
                }
            });
			 $("#categoryImages").on('click','.btn-danger', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });

            $( "#categoryImages_2" ).sortable();
            $("#upload_images_2").on('change', function () {
                var images = $('#upload_images_2')[0];
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
                                    var tr = '<tr><td><input type="hidden" name="images_2[]" value="'+file+'"><img src="'+file+'"></td><td style="width: 60%"><input placeholder="Link" class="form-control" name="links_2[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>';
                                    $("#categoryImages_2").append(tr);
                                });
                            } else {
                                showMessage('file not uploaded', 'alert');
                            }
                            $('#upload_images_2').val('');
                        },
                    });
                }
            });

            $("#categoryImages_2").on('click','.btn-danger', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
			
			$("#categoryMobileImages").sortable();
            $("#upload_mobile_images").on('change', function () {
                var images = $('#upload_mobile_images')[0];
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
                                    var tr = '<tr><td><input type="hidden" name="mobile_images[]" value="'+file+'"><img src="'+file+'"></td><td style="width: 60%"><input placeholder="Link" class="form-control" name="mobile_links[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>';
                                    $("#categoryMobileImages").append(tr);
                                });
                            } else {
                                showMessage('file not uploaded', 'alert');
                            }
                            $('#upload_mobile_images').val('');
                        },
                    });
                }
            });

            $("#categoryMobileImages").on('click','.btn-danger', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });

            $("#categoryMobileImages_2").sortable();
            $("#upload_mobile_images_2").on('change', function () {
                var images = $('#upload_mobile_images_2')[0];
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
                                    var tr = '<tr><td><input type="hidden" name="mobile_images_2[]" value="'+file+'"><img src="'+file+'"></td><td style="width: 60%"><input placeholder="Link" class="form-control" name="mobile_links_2[]" type="text"></td><td><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button></td></tr>';
                                    $("#categoryMobileImages_2").append(tr);
                                });
                            } else {
                                showMessage('file not uploaded', 'alert');
                            }
                            $('#upload_mobile_images_2').val('');
                        },
                    });
                }
            });

            $("#categoryMobileImages_2").on('click','.btn-danger', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
            $('input[name="is_menu"]').change(function(){
                 if(this.checked){
                      $(this).val(1);
                 }else{
                      $(this).val(0);
                 }
            });
        })
    </script>
@endpush
