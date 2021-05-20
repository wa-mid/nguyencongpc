@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Product &nbsp;&nbsp;
                @can('product-create')
                    <a href="{{route("admin.products.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Product</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter-button" action='{{route("admin.products.index")}}'>
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
                                    {!! $allCategories->placeholder(0, '--Chọn Chuyên mục--')->renderAsDropdown() !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::select('attribute', $allAttributes, $filter['attribute'], array('class' => 'form-control', 'placeholder' => "Thuộc tính")) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::select('status', array( '1' => 'Còn hàng', '2' => 'Hết hàng', '0' => 'Ngừng kinh doanh'), $filter['status'], array('class' => 'form-control', 'placeholder' => "Trạng thái")) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.products.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <form id='form-product-list' method='post' action='{{route("admin.products.index")}}'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- /.box-header -->
                    <div class="box-header">
                        <div class="pull-left">
                            <select onchange="$('#form-product-list').submit()" name='command' id="slt-command" style="width: 164px;" disabled class='form-control input-sm'>
                                <option selected value="">Chuyển tất cả đánh dấu</option>
                                <option value="status1">--> Còn hàng</option>
                                <option value="status2">--> Hết hàng</option>
                                <option value="status0">--> Ngừng kinh doanh</option>
                                <option value="attribute1">--> Sản phẩm khuyến mại</option>
                                <option value="attribute2">--> Bỏ khuyến mại</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body no-padding" style="overflow: auto;">
                        <table class="table table-bordered product-table" id="product-table">
                            <tr>
                                <th width="3%" style="text-align: center"><input type="checkbox" id="checkall"></th>
                                <th>Name</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Status</th>
                                <th width="120px">Action</th>
                            </tr>
                            @foreach ($data as $key => $product)
                                <tr>
                                    <td width="3%" style="text-align: center"><input type="checkbox" class="cb-ids" name="ids[]" value="{{$product->id}}"></td>
                                    <td>
                                        <img class="product-img" src="{{ $product->getImage(80) }}">
                                        <p>{{ $product->name }}</p>
                                        <p>@foreach($product->getProductAttributes() as $att)<span class="label label-success">{{$att}}</span> @endforeach
                                        @if($product->is_delete)<span class="label label-danger">SP Ẩn</span>@endif
                                        </p>
                                    </td>
                                    <td>
                                        <span class="new-price">{{Helper::formatMoney($product->getPriceLabel())}}</span>
                                        <span class="old-price">{{Helper::formatMoney($product->getOldPriceLabel())}}</span>
                                    </td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->getStatusText()}}</td>
                                    <td>
                                        <a href="{{ $product->getDetailLink() }}" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                        @can('product-edit')
                                            <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('product-delete')
                                            <button class="btn btn-danger btn-xs" onclick="deleteProduct({{$product->id}})" type="button"><i class="fa fa-times"></i></button>
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
                </form>
            </div>
        </section>
        <div style="display: none">
            {!! Form::open(['method' => 'DELETE', 'id' => 'form-delete', 'route' => ['admin.promotions.destroy', 1],'style'=>'display:inline']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script type="text/javascript">
        function deleteProduct(id) {
          if(confirm('Bạn có chắc chắn muốn xóa?')) {
            $("#form-delete").attr("action", '/admin/products/delete/'+id).submit();
            return true;
          }
        }
      $(document).ready(function () {
        $("#product-table .cb-ids").click(function() {
          var is_any_checked = $("#product-table .cb-ids:checked").length;
          if(is_any_checked) {
            $("#slt-command").attr("disabled", false);
          }else{
            $("#slt-command").attr("disabled", true);
          }
        })

        $("#product-table #checkall").click(function() {
          var is_checked = $(this).is(":checked");
          $("#product-table .cb-ids").prop("checked",!is_checked).trigger("click");
        })
      });
    </script>
@endpush