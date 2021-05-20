@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$option->id ? 'Edit Option' : 'New Option'}} &nbsp;&nbsp;
                <a href="{{route("admin.options.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Option</a>
                @if($option->id)
                    <a href="{{route("admin.options.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Option</a>
                @endif
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($option, ['method' => 'POST','route' => $option->id ? ['admin.options.edit', $option->id] : 'admin.options.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Option</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Other</a></li>
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
                                    {!! Form::text('key', null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Định dạng</strong>
                                    {!! Form::select('type', array( 'text' => 'Text', 'html' => 'Html'), $option->type, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Giá trị</strong>
                                    {!! Form::textarea('value', null, array('placeholder' => 'Giá trị','id' => 'option-content','class' => 'form-control')) !!}
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


@push('bottom')
    @if($option->type == 'html')
    <script src="/adminlte/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script>
        $(function () {
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
            };
            CKEDITOR.replace('option-content', options);
        })
    </script>
    @endif
@endpush
