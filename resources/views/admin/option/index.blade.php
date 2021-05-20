@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Option &nbsp;&nbsp;
                @can('option-create')
                    <a href="{{route("admin.options.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Option</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-bordered option-table">
                        <tr>
                            <th>No</th>
                            <th>Tên</th>
                            <th>Giá trị</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $option)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $option->key }}</td>
                                <td>{{str_limit($option->value, 100)}}</td>
                                <td>
                                    @can('option-edit')
                                        <a href="{{ route('admin.options.edit',$option->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('option-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.options.destroy', $option->id],'style'=>'display:inline']) !!}
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