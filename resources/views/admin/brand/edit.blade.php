@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$brand->id ? 'Edit Brand' : 'New Brand'}} &nbsp;&nbsp;
                <a href="{{route("admin.brands.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Brand</a>
                @if($brand->id)
                    <a href="{{route("admin.brands.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Brand</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($brand, ['method' => 'POST','route' => $brand->id ? ['admin.brands.edit', $brand->id] : 'admin.brands.create', 'enctype' => "multipart/form-data"]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Slug:</strong>
                                {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Parent:</strong>
                                {!! $allBrands->placeholder(0, '--Brand parent--')->renderAsDropdown() !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Ảnh chính</strong>
                                <div class="image-field">
                                    @if($brand->image)
                                        <img style="max-width:150px;height: 50px;" src="{{asset($brand->image)}}">
                                    @endif
                                    {!! Form::file('image', array('placeholder' => 'Image')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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
