@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$slide->id ? 'Edit Slide' : 'New Slide'}} &nbsp;&nbsp;
                <a href="{{route("admin.slide.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Slide</a>
                @if($slide->id)
                    <a href="{{route("admin.slide.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Slide</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($slide, ['method' => 'POST','route' => $slide->id ? ['admin.slide.edit', $slide->id] : 'admin.slide.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Slide</a></li>
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
                                    {!! Form::text('name', null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Link</strong>
                                    {!! Form::text('link', null, array('placeholder' => 'Link','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Ảnh</strong>
                                    <div class="image-field">
                                        @if($slide->file)
                                            <img style="max-width:150px;height: 50px;" src="{{asset($slide->file)}}">
                                        @endif
                                        {!! Form::file('file', array('placeholder' => 'Ảnh')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">


                                <div class="form-group">
                                    <strong>Priority</strong>
                                    {!! Form::text('priority', null, array('placeholder' => 'Priority','class' => 'form-control ip-number')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('status', array( '1' => 'Enable', '0' => 'Disable'), $slide->status, array('class' => 'form-control')) !!}
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
    <script src="/adminlte/jquery.number/jquery.number.js"></script>
    <script>
        $(function () {
            $(".ip-number").number(true, 0);

        })

    </script>
@endpush
