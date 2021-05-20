@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{ $filter->id ? 'Chỉnh sửa bộ lọc' : 'Thêm mới bộ lọc'}} &nbsp;&nbsp;
                <a href="{{route("admin.filters.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Quản lý bộ lọc</a>
                @if($filter->id)
                    <a href="{{route("admin.filters.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Thêm mới bộ lọc</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($filter, ['method' => 'POST','route' => $filter->id ? ['admin.filters.edit', $filter->id] : 'admin.filters.create', 'enctype' => "multipart/form-data"]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Slug:</strong>
                                {!! Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Parent:</strong>
                                {!! $allFilters->placeholder(0, '--Filter parent--')->renderAsDropdown() !!}
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
