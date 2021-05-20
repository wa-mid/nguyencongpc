@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$promotion->id ? 'Edit Promotion' : 'New Promotion'}} &nbsp;&nbsp;
                <a href="{{route("admin.promotions.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Promotion</a>
                @if($promotion->id)
                    <a href="{{route("admin.promotions.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Promotion</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box no-border">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($promotion, ['method' => 'POST','route' => $promotion->id ? ['admin.promotions.edit', $promotion->id] : 'admin.promotions.create', 'enctype' => "multipart/form-data"]) !!}
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Description:</strong>
                                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Image:</strong>
                                <div class="image-field">
                                    @if($promotion->image)
                                        <img style="max-width:150px;height: 50px;" src="{{asset($promotion->image)}}">
                                    @endif
                                    {!! Form::file('image', array('placeholder' => 'Image')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <strong>Status:</strong>
                                {!! Form::select('status', array( '1' => 'Enable', '0' => 'Disable'), $promotion->status, array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Publish At:</strong>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="published_at" value="{{$promotion->published_at ? Helper::formatDateFromString($promotion->published_at, 'd/m/Y') : date('d/m/Y')}}" class="form-control pull-right" id="datepicker">
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
