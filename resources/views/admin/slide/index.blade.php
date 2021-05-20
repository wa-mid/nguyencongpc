@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Slide &nbsp;&nbsp;
                @can('slide-create')
                    <a href="{{route("admin.slide.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Slide</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered slide-table">
                        <tr>
                            <th>No</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Link</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $slide)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $slide->name }}</td>
                                <td><img class="list-img" src="{{ asset($slide->getImage()) }}"></td>
                                <td>{{ $slide->link }}</td>
                                <td>{{ $slide->priority }}</td>
                                <td>{{ $slide->getStatusText()}}</td>
                                <td>
                                    @can('slide-edit')
                                        <a href="{{ route('admin.slide.edit',$slide->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('slide-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.slide.destroy', $slide->id],'style'=>'display:inline']) !!}
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