@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$video->id ? 'Edit Video' : 'New Video'}} &nbsp;&nbsp;
                <a href="{{route("admin.video.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Video</a>
                @if($video->id)
                    <a href="{{route("admin.video.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Video</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($video, ['method' => 'POST','route' => $video->id ? ['admin.video.edit', $video->id] : 'admin.video.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Video</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
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
                                    <strong>Mô tả</strong>
                                    {!! Form::textarea('description', null, array('placeholder' => 'Mô tả','class' => 'form-control','rows' => 3)) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Link Video</strong>
                                    {!! Form::text('link', null, array('placeholder' => 'Link Video','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Priority</strong>
                                    {!! Form::text('priority', null, array('placeholder' => 'Priority','class' => 'form-control ip-number')) !!}
                                </div>

                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('status', array( '1' => 'Enable', '0' => 'Disable'), $video->status, array('class' => 'form-control')) !!}
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
