@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$kiotviet->id ? 'Edit KiotViet' : 'New KiotViet'}} &nbsp;&nbsp;
                <a href="{{route("admin.kiotviet.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin KiotViet</a>
                @if($kiotviet->id)
                    <a href="{{route("admin.kiotviet.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New KiotViet</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($kiotviet, ['method' => 'POST','route' => $kiotviet->id ? ['admin.kiotviet.edit', $kiotviet->id] : 'admin.kiotviet.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">KiotViet</a></li>
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
                                        @if($kiotviet->file)
                                            <img style="max-width:150px;height: 50px;" src="{{asset($kiotviet->file)}}">
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
                                    {!! Form::select('status', array( '1' => 'Enable', '0' => 'Disable'), $kiotviet->status, array('class' => 'form-control')) !!}
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
