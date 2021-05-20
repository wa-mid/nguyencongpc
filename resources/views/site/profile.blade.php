@extends('layout.layout')

@section('content')
    <div id="content">
        <div class="container">
	        <div id="profile-user">
		        <div class="row">
					<div class="col-md-12">
						@if ($message = Session::get('success'))
							<div class='alert alert-success alert-dismissible'>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<span><i class="icon fa fa-info"></i> {{ $message }}</span>
							</div>
						@endif
						@if ($error = Session::get('error'))
							<div class='alert alert-danger alert-dismissible'>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<span><i class="icon fa fa-info"></i> {{$error}}</span>
							</div>
						@endif
					</div>

			        <div class="col-12 col-md-6">
				        <div class="caption">
					        <p>Thông tin cá nhân</p>
				        </div>
				        <div class="content">
					        <div>
						        <form method="POST" action="/thong-tin-ca-nhan">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							        <div class="form-group">
								        <label for="exampleInputPassword1">Họ tên</label>
								        <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Họ tên">
							        </div>
							        <div class="form-group">
								        <label for="exampleInputPassword1">Số điện thoại</label>
								        <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Số điện thoại">
							        </div>
									<div class="form-group">
								        <label for="exampleInputPassword1">Địa chỉ</label>
								        <input type="text" class="form-control" name="address" value="{{$user->address}}" placeholder="Địa chỉ">
							        </div>
							        <div class="form-group">
								        <label for="exampleInputPassword1">Địa chỉ email</label>
								        <input type="text" class="form-control" value="{{$user->email}}" disabled placeholder="Email">
							        </div>
							        <div class="form-group text-right">
								        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
							        </div>
						        </form>
					        </div>
				        </div>
			        </div>
			        <div class="col-12 col-md-6">
				        <div class="caption">
					        <p>Đổi mật khẩu</p>
				        </div>
				        <div class="content">
					        <div>
						        <form method="POST" action="/doi-mat-khau">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							        <div class="form-group">
								        <label for="exampleInputPassword1">Mật khẩu cũ</label>
								        <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ">
							        </div>
							        <div class="form-group">
								        <label for="exampleInputPassword1">Mật khẩu mới</label>
								        <input type="password" name="new_password" class="form-control" placeholder="Mật khẩu mới">
							        </div>
							        <div class="form-group">
								        <label for="exampleInputPassword1">Xác nhận mật khẩu</label>
								        <input type="password" name="new_password_again" class="form-control" placeholder="Xác nhận mật khẩu">
							        </div>
							        
							        <div class="form-group text-right">
								        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
							        </div>
						        </form>
					        </div>
				        </div>
			        </div>
		        </div>
		        <div class="row">
			        <div class="col-12 col-md-12">
				        <div class="caption">
					        <p>Lịch sử đơn hàng</p>
				        </div>
						<div style="overflow-x: auto">
				        <table style="min-width: 600px" class="table table-striped">
						  <thead>

						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Sản phẩm</th>
						      <th style="min-width: 150px" scope="col">Đơn giá</th>
						      <th scope="col">Số lượng</th>
						      <th style="min-width: 150px" scope="col">Thành tiền</th>
						    </tr>
						  </thead>
						  <tbody>
						  @if(isset($orders) && $orders->isNotEmpty())
						  	@foreach($orders as $order)
								<?php $orderDetails =  $order->getOrderDetail();?>
								@if($orderDetails->isNotEmpty())
									<tr>
									  <th colspan="5">Đơn hàng #{{$order->id}}  <span class="pull-right">Ngày: {{Helper::formatDateFromString($order->created_at, 'd/m/Y')}}</span></th>
									</tr>
									@foreach($orderDetails as $index => $product)
										<tr>
											<td>{{$index+1}}</td>
											<td style="font-weight: bold"><a href="{{$product->slug}}">{{$product->name}}</a></td>
											<td>{{Helper::formatMoney($product->price)}}</td>
											<td>{{$product->quantity}}</td>
											<td>{{Helper::formatMoney($product->total)}}</td>
										</tr>
									@endforeach
									<tr>
										<th></th>
										<th colspan="3">Tổng</th>
										<td style="color:#ff0000">{{Helper::formatMoney($order->total)}}</td>
									</tr>
								@endif
							@endforeach
						  @else
							  <tr>
								  <td colspan="5" class="text-center">Bạn chưa có đơn hàng nào</td>
							  </tr>
							  @endif
						  </tbody>
						</table>
						</div>
			        </div>
		        </div>
	        </div>
        </div>
    </div>

@endsection
