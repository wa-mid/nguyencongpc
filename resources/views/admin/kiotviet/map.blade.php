@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Map Product
                @can('kiotviet-list')
                    <a href="{{route("admin.kiotviet.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> DS sản phẩm trên Web</a>
                @endcan
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($product, ['method' => 'POST','route' => ['admin.kiotviet.map', $product->id], 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Product</a></li>
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
                                    <strong>Tên sản phẩm</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'disabled')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Sản phẩm Kiot viet</strong>
                                    {!! Form::select('kiot_viet_id', $allKiotViet, $product->kiot_viet_id, array('class' => 'form-control select2', 'placeholder' => 'Chọn sản phẩm bên KiotViet')) !!}
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
    <!-- Select2 -->
    <script src="/adminlte/select2/select2.full.min.js"></script>
    <script>
        $(function () {
            $('.select2').select2()
        })

    </script>
@endpush
