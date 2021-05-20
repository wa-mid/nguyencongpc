@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                DS SP KiotViet &nbsp;&nbsp;
                @can('kiotviet-list')
                    <a href="{{route("admin.kiotviet.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> DS sản phẩm trên Web</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered kiotviet-table">
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Base Price</th>
                            <th>Tồn kho</th>
                            <th>Trạng thái</th>
                            <th>Ngày cập nhật</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $kiotviet)
                            <tr>
                                <td>{{ $kiotviet->id }}</td>
                                <td>{{ $kiotviet->code }}</td>
                                <td>{{ $kiotviet->name }}</td>
                                <td>{{ $kiotviet->basePrice }}</td>
                                <td>{{ $kiotviet->onHand }}</td>
                                <td>{{ $kiotviet->isActive ? 'Active' : 'No'}}</td>
                                <td>{{ Helper::formatDateFromString($kiotviet->modifiedDate, 'd/m/Y H:i')}}</td>
                                <td>
                                    @can('kiotviet-edit')
                                        {!! Form::open(['method' => 'post','route' => ['admin.kiotviet.refresh', $kiotviet->id],'style'=>'display:inline']) !!}
                                        <button class="btn btn-info btn-xs" type="submit"><i class="fa fa-refresh"></i></button>
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