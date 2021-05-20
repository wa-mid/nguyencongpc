@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Quản lý chuyên mục tin tức &nbsp;&nbsp;
                @can('postCategory-create')
                    <a href="{{route("admin.postCategory.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-bordered postCategory-table">
                        <tr>
                            <th>No</th>
                            <th>Tên</th>
                            <th>Trạng thái</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $postCategory)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $postCategory->name }}</td>
                                <td>{{ $postCategory->getStatusText()}}</td>
                                <td>
                                    @can('postCategory-edit')
                                        <a href="{{ route('admin.postCategory.edit',$postCategory->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('postCategory-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.postCategory.destroy', $postCategory->id],'style'=>'display:inline']) !!}
                                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
                                            {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <div class="box-tools pull-right">
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection