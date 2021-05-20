@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin KiotViet Invoice &nbsp;&nbsp;
                @can('kiotviet-order-sync')
                    <a href="{{route("admin.kiotvietinvoices.sync")}}" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Đồng bộ</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter" action='{{Request::url()}}'>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="input_term" name="code" value="{{$filter['code']}}" placeholder="Mã hóa đơn">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="createdDate" value="{{$filter['createdDate']}}" class="form-control" id="datepicker">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="filter_status" name="status">
                                        <option value="2" {{$filter['status'] == 2 ? 'selected' : ''}}>Trạng thái</option>
                                        <option value="0" {{$filter['status'] == 0 ? 'selected' : ''}}>Chưa kiểm tra</option>
                                        <option value="1" {{$filter['status'] == 1 ? 'selected' : ''}}>Đã kiểm tra</option>
                                    </select>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="filter_branchName" {{$filter['branchNameDisable'] ? 'disabled' : ''}} name="branchName">
                                        <option value="">Chi nhánh</option>
                                        <option value="Chi nhánh trung tâm" {{$filter['branchName'] == 'Chi nhánh trung tâm' ? 'selected' : ''}}>Chi nhánh trung tâm</option>
                                        <option value="Chi Nhánh 2" {{$filter['branchName'] == 'Chi Nhánh 2' ? 'selected' : ''}}>Chi Nhánh 2</option>
                                        <option value="176 Tân Phước - HCM" {{$filter['branchName'] == '176 Tân Phước - HCM' ? 'selected' : ''}}>176 Tân Phước - HCM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.kiotvietinvoices.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Chi nhánh</th>
                            <th>Khách hàng</th>
                            <th class="text-right">Tổng tiền</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Kiểm tra</th>
                            <th>Người cập nhật</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach ($data as $i => $invoice)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $invoice->code }}</td>
                                <td>{{ $invoice->branchName }}</td>
                                <td>{{ $invoice->customerName }}</td>
                                <td class="text-right">{{ number_format($invoice->total) }}</td>
                                <td>{{ Helper::formatDateFromString($invoice->createdDate, 'd/m/Y H:i:s') }}</td>
                                <td class="text-center">{{ $invoice->getSysStatus() }}</td>
                                <td>{{ $invoice->updated_by_name }}</td>
                                <td class="text-center">
									@if($invoice->sys_status == 0)
										@can('kiotviet-order-edit')
											<a href="{{ route('admin.kiotvietinvoices.edit',$invoice->code) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
										@endcan
									@endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <div class="col-sm-5"><div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} entries</div></div>
                    <div class="col-sm-7">
                        <div class="box-tools pull-right">
							{!! urldecode(str_replace("/?","?",$data->appends(Request::all())->render())) !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('bottom')
    <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="/adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(function () {
        $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });
      })

    </script>
@endpush