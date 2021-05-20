@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Redirect &nbsp;&nbsp;
                @can('redirect-create')
                    <a href="{{route("admin.redirect.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Redirect</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered redirect-table">
                        <tr>
                            <th>No</th>
                            <th>Link nguồn</th>
                            <th>Link đích</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $redirect)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $redirect->source }}</td>
                                <td>{{ $redirect->redirect }}</td>
                                <td>
                                    @can('redirect-edit')
                                        <a href="{{ route('admin.redirect.edit',$redirect->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('redirect-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.redirect.destroy', $redirect->id],'style'=>'display:inline']) !!}
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