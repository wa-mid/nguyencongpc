@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Orders &nbsp;&nbsp;
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter-button" action='{{Request::url()}}'>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="input_term" name="term" value="{{$filter['term']}}" placeholder="Search">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::select('status', array( '0' => 'Đơn mới','1' => 'Đang xử lý', '2' => 'Hoàn Thành', '3' => 'Hủy Đơn'), $filter['status'], array('class' => 'form-control', 'placeholder' => "Trạng thái")) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.orders.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered orders-table">
                        <tr>
                            <th>No</th>
                            <th>Tên</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{$order->customer_phone}}</td>
                                <td>{{ $order->customer_address }}</td>
                                <td>{{ Helper::formatMoney($order->total) }}</td>
                                <td <?php if ($order->getStatusText() == "Đơn mới" ){echo "style=background:#fbff00;";} elseif ($order->getStatusText() == "Đang xử lý" ) {echo "style=background:#00fff3;";}elseif ($order->getStatusText() == "Hoàn Thành" ) {echo "style=background:#00a65a;";}else  {echo "style=background:red;";}?>>{{ $order->getStatusText()}}</td>
                                <td>{{ Helper::formatDateFromString($order->created_at, 'd/m/Y') }}</td>
                                <td>{{ Helper::formatDateFromString($order->updated_at, 'd/m/Y') }}</td>
                                <td >
                                    @can('orders-view')
                                        <a href="{{ route('admin.orders.view',$order->id) }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('orders-edit')
                                        <a href="{{ route('admin.orders.edit',$order->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('orders-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.orders.destroy', $order->id],'style'=>'display:inline']) !!}
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