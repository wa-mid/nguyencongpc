@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Chi tiết đơn hàng #{{$order->id}}
            </h1>
        </section>

        <section class="invoice">
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                    Khách hàng
                    <address>
                        <strong>{{$order->customer_name}}</strong><br>
                        Điện thoại: {{$order->customer_phone}}<br>
                        Địa chỉ: {{$order->customer_address}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Đơn hàng #{{$order->id}}</b><br>
                    <br>
                    <b>Ngày Tạo:</b> {{ Helper::formatDateFromString($order->created_at, 'd/m/Y H:i') }}<br>
                    <b>Ngày Cập nhật:</b> {{ Helper::formatDateFromString($order->updated_at, 'd/m/Y H:i') }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
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
                                    <td>{{$index+1}}</td>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection

