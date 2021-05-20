@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$postCategory->id ? 'Chỉnh sửa chuyên mục' : 'Thêm mới chuyên mục'}} &nbsp;&nbsp;
                <a href="{{route("admin.postCategory.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Danh sách</a>
                @if($postCategory->id)
                    <a href="{{route("admin.postCategory.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Thêm mới chuyên mục</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($postCategory, ['method' => 'POST','route' => $postCategory->id ? ['admin.postCategory.edit', $postCategory->id] : 'admin.postCategory.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Thông tin</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Tên</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Slug</strong>
                                    {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('is_active', array( '1' => 'Enable', '0' => 'Disable'), $postCategory->is_active, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Chuyên mục tin tức</strong>
                                    {!! Form::select('is_post', array( '1' => 'Tin tức', '0' => 'Trang khác'), $postCategory->is_post, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Thứ tự</strong>
                                    {!! Form::number('priority', null, array('placeholder' => 'Thứ tự','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
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
