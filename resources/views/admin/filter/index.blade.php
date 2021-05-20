@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Filter Shop setting -->
            <h1>
                Admin Filter &nbsp;&nbsp;
                @can('filter-create')
                    <a href="{{route("admin.filters.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Filter</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dd" id="nestable">
                        @include( 'admin.filter.nestable', array('filters' => $filters))
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script src="/adminlte/jquery.nestable/jquery.nestable.js"></script>
    <script>
        var updateTree = function(e) {
            var out = $(e.target).nestable('serialize');
            out     = JSON.stringify(out);
            var formData = new FormData();
            formData.append('tree', out);
            var url  = '{{route('admin.filters.tree')}}';
            $.ajax( {
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function (data, textStatus, jqXHR)
                {
                    showMessage('Lưu chuyên mục thành công');
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
        };
        $('#nestable').nestable({
        }).on('change', updateTree);
    </script>
@endpush