@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Promotion &nbsp;&nbsp;
                @can('promotion-create')
                    <a href="{{route("admin.promotions.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Promotion</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Published At</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($data as $key => $promotion)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ Str::limit($promotion->description, 50) }}</td>
                                <td>{{Helper::formatDateFromString($promotion->published_at)}}</td>
                                <td>{{ $promotion->status ? 'Enable' : 'Disable' }}</td>
                                <td>
                                    @can('promotion-edit')
                                        <a href="{{ route('admin.promotions.edit',$promotion->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('promotion-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.promotions.destroy', $promotion->id],'style'=>'display:inline']) !!}
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