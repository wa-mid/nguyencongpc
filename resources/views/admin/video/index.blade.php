@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Video &nbsp;&nbsp;
                @can('video-create')
                    <a href="{{route("admin.video.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Video</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered video-table">
                        <tr>
                            <th>No</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $video)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->link }}</td>
                                <td>{{ $video->priority }}</td>
                                <td>{{ $video->getStatusText()}}</td>
                                <td>
                                    @can('video-edit')
                                        <a href="{{ route('admin.video.edit',$video->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('video-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.video.destroy', $video->id],'style'=>'display:inline']) !!}
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
                        {!! urldecode(str_replace("/?","?",$data->appends(Request::all())->render())) !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection