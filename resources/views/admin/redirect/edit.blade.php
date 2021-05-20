@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$redirect->id ? 'Edit Redirect' : 'New Redirect'}} &nbsp;&nbsp;
                <a href="{{route("admin.redirect.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Redirect</a>
                @if($redirect->id)
                    <a href="{{route("admin.redirect.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Redirect</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($redirect, ['method' => 'POST','route' => $redirect->id ? ['admin.redirect.edit', $redirect->id] : 'admin.redirect.create', 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Redirect</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Link Nguồn</strong>
                                    {!! Form::text('source', null, array('placeholder' => 'Link Nguồn','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Link Redirect</strong>
                                    {!! Form::text('redirect', null, array('placeholder' => 'Link Redirect','class' => 'form-control')) !!}
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
