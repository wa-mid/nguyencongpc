@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                DS Sản phẩm trên Web &nbsp;&nbsp;
                @can('kiotviet-product')
                    <a href="{{route("admin.kiotviet.mapIndex")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Danh sách Sp trên KiotViet</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter-button" action='{{route("admin.kiotviet.index")}}'>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="input_term" name="term" value="{{$filter['term']}}" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! $allCategories->placeholder(0, '--Chọn Chuyên mục--')->renderAsDropdown() !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.products.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-bordered product-table">
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Tên</th>
                            <th>Tên Kiot Viet</th>
                            <th>Số lượng</th>
                            <th>Status</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->kiot_viet_name }}</td>
                                <td>{{ $product->amount }}</td>
                                <td>{{ $product->getStatusText()}}</td>
                                <td>
                                    @can('product-edit')
                                        <a href="{{ route('admin.kiotviet.map',$product->id) }}" class="btn btn-xs btn-info"><i class="fa fa-arrow-right"></i></a>
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