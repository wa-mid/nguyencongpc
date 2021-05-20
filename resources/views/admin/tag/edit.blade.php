@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$tag->id ? 'Edit Tag' : 'New Tag'}} &nbsp;&nbsp;
                <a href="{{route("admin.tags.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Tag</a>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box no-border">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($tag, ['method' => 'POST','route' => $tag->id ? ['admin.tags.edit', $tag->id] : 'admin.tags.create', 'enctype' => "multipart/form-data"]) !!}
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Slug:</strong>
                                {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                            </div>
							<div class="form-group">
                                <strong>Description:</strong>
                                {!! Form::text('meta_desc', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                            </div>
							<div class="form-group">
                                <strong>Keywords:</strong>
                                {!! Form::text('meta_keywords', null, array('placeholder' => 'Keywords','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Suggest:</strong>
                                {!! Form::select('suggest', array( '1' => 'Yes', '0' => 'No'), $tag->suggest, array('class' => 'form-control', 'placeholder' => "Suggest")) !!}
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-sm-12 col-md-6">
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
    <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="/adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
            })
        })
    </script>
@endpush
