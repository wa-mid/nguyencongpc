@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Chỉnh sửa đơn hàng #{{$order->id}}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            {!! Form::model($order, ['method' => 'POST','route' => ['admin.orders.edit', $order->id], 'enctype' => "multipart/form-data"]) !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Order</a></li>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Tên khách hàng</strong>
                                    {!! Form::text('customer_name', null, array('placeholder' => 'Tên khách hàng','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Số điện thoại</strong>
                                    {!! Form::text('customer_phone', null, array('placeholder' => 'Số điện thoại','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Địa chỉ</strong>
                                    {!! Form::text('customer_address', null, array('placeholder' => 'Địa chỉ','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Trạng thái</strong>
                                    {!! Form::select('status', array( '0' => 'Đơn mới','1' => 'Đang xử lý', '2' => 'Hoàn Thành', '3' => 'Hủy Đơn'), $order->status, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                        </thead>
                                        @if($orderDetail->isNotEmpty())
                                            <tbody>
                                            @foreach($orderDetail as $index => $product)

                                                <tr>
                                                    <td>{{ $index+1}} </td>
                                                    <td><a href="https://nguyencongpc.vn/{{$product->slug}}" target="_blank">{{$product->name}}</a></td>
                                                    <td>{{$product->price}}</td>
                                                    <td>{{$product->quantity}}</td>
                                                    <td>{{Helper::formatMoney($product->total)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="4">Tổng</td>
                                                <td>{{Helper::formatMoney($orderDetail->sum('total'))}}</td>
                                            </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script src="/adminlte/jquery.number/jquery.number.js"></script>
    <script>
        $(function () {
            $(".ip-number").number(true, 0);

        })

    </script>
@endpush
