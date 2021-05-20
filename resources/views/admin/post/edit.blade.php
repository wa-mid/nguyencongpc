@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$post->id ? 'Edit Post' : 'New Post'}} &nbsp;&nbsp;
                <a href="{{route("admin.posts.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Post</a>
                @if($post->id)
                    <a href="{{route("admin.posts.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Post</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($post, ['method' => 'POST','route' => $post->id ? ['admin.posts.edit', $post->id] : 'admin.posts.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Post</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Other</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        @if($post->slug)
                        <a href="{{ $post->getDetailLink() }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Preview</a>
                        @endif
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Tiêu đề</strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Tiêu đề','class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Nội dung</strong>
                                    {!! Form::textarea('content', null, array('placeholder' => 'Nội dung','class' => 'form-control', 'id' => 'post-content')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Chuyên mục</strong>
                                    <select class="form-control" id="input_category_id" name="category_id">
                                        <option value="">All</option>
                                        @foreach($allCategories as $category)
                                            <option value="{{$category->id}}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <strong>Mô tả</strong>
                                    {!! Form::textarea('description', null, array('placeholder' => 'Mô tả','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Ảnh chính</strong>
                                    <div class="field-image">
                                        <div class="input-group">
                                            <a id="image_upload_btn" data-input="image_input" data-preview="image_preview" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Chọn ảnh
                                            </a>
                                            <input id="image_input" class="form-control" value="{{$post->image}}" type="hidden" name="image">
                                        </div>
                                        <div class="pimage">
                                            <img id="image_preview" style="max-width:150px;height: 100px;min-width: 50px;margin-right:0;" src="{{asset($post->image)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <strong>Tin trang chủ</strong>
                                    {!! Form::select('is_home', array( '0' => 'Không', '1' => 'Có'), $post->is_home, array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Số lượng view</strong>
                                    {!! Form::text('views_count', null, array('placeholder' => 'Số lượng view','class' => 'form-control ip-number')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('status', array( '1' => 'Enable', '0' => 'Disable'), $post->status, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>Publish Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="published_at" value="{{$post->published_at ? Helper::formatDateFromString($post->published_at, 'd/m/Y') : date('d/m/Y')}}" class="form-control pull-right" id="datepicker">
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
                                    <strong>Meta Description</strong>
                                    {!! Form::textarea('meta_desc', null, array('placeholder' => 'Meta Description','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Meta Keywords</strong>
                                    {!! Form::textarea('meta_keywords', null, array('placeholder' => 'Meta Keywords','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
								<div class="form-group">
                                    <strong>Meta Pixel</strong>
                                    {!! Form::textarea('meta_pixel', null, array('placeholder' => 'Meta Pixel','class' => 'form-control')) !!}
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
    <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="/adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/jquery.number.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $(function () {
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&responseType=json&_token={{ csrf_token() }}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&responseType=json&_token={{ csrf_token() }}'
            };
            CKEDITOR.replace('post-content', options);
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy'
            });
            $(".ip-number").number(true, 0);
            $('#image_upload_btn').filemanager('image');
        })

    </script>
@endpush
