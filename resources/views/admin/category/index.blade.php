@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Category &nbsp;&nbsp;
                @can('category-create')
                    <a href="{{route("admin.categories.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Category</a>
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
                        @include( 'admin.category.nestable', array('categories' => $categories))
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
            var url  = '{{route('admin.categories.tree')}}';
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