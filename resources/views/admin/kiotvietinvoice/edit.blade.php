@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Check hóa đơn #{{$invoice->code}} &nbsp;&nbsp;
                <a href="{{route("admin.kiotvietinvoices.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Invoice</a>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box no-border">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($invoice, ['method' => 'POST','route' => ['admin.kiotvietinvoices.edit', $invoice->code]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>Chi tiết hóa đơn</strong>
                                <textarea class="form-control" rows="{{$numRows}}" disabled id="invoiceDetails">{{$invoiceDetails->map(function($item) {return $item->productCode.':'.$item->quantity.': _'.Helper::cutString($item->productName, 15);})->join("\n")}}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>Dữ liệu kiểm tra</strong>
                                <textarea name="textcheck" class="form-control" rows="{{$numRows}}" id="inputCheck"></textarea>
                            </div>

                            <button type="button" id="btn-check" class="btn btn-primary">Kiểm tra</button>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <strong>Kết quả</strong>
                                <div class="form-control" id="result" style="height:auto;"></div>
                            </div>
                            <button type="submit" id="btn-submit" disabled class="btn btn-primary">Lưu lại</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('bottom')
    <script>
      $(function () {
        $("#btn-check").click(function() {
          var details = $("#invoiceDetails").val();
          details = details.split('\n');
          var invoiceDetails = {};
          details.forEach(function (item) {
			var fields = item.split(':');
			var productCode = fields[0].trim();
			var productQuantity = fields[1] ? parseInt(fields[1].trim()) : 1;
			if(invoiceDetails[productCode]) {
				invoiceDetails[productCode] += productQuantity;
			} else {
				invoiceDetails[productCode] = productQuantity ? productQuantity : 1
			}
          });
          var check = $("#inputCheck").val();
		  var checkProducts = {};
		  check.split('\n').forEach(function (item) {
			var fields = item.split(':');
			var productCode = fields[0].trim();
			var productQuantity = fields[1] ? parseInt(fields[1].trim()) : 1;
			if(checkProducts[productCode]) {
				checkProducts[productCode] += productQuantity;
			} else {
				checkProducts[productCode] = productQuantity ? productQuantity : 1
			}
          });

          var result = [];
          var status = true;
		  Object.keys(invoiceDetails).forEach(function(productCode) {
            if(productCode) {
              if(checkProducts[productCode]) {
				  if(checkProducts[productCode] > invoiceDetails[productCode]) {
					  result.push('<span class="text-red">'+productCode+': Thừa '+(checkProducts[productCode] - invoiceDetails[productCode]).toString()+' SP</span>');
					  status = false;
				  } else if (checkProducts[productCode] < invoiceDetails[productCode]) {
					  result.push('<span class="text-yellow">'+productCode+': Thiếu '+(invoiceDetails[productCode] - checkProducts[productCode]).toString()+' SP</span>');
					  status = false;
				  } else {
					  result.push('<span class="text-green">'+productCode+': OK</span>');
				  }
              } else {
                result.push('<span class="text-yellow">'+productCode+': Thiếu '+invoiceDetails[productCode].toString()+' SP</span>');
                status = false;
              }
            }
          });
		  Object.keys(checkProducts).forEach(function(productCode) {
            if(productCode) {
              if(!invoiceDetails[productCode]) {
				  result.push('<span class="text-red">'+productCode+': Thừa '+checkProducts[productCode].toString()+' SP</span>');
				  status = false;
              }
            }
          });
          $("#result").html(result.join('<br>'));
          if(status) {
            $('#btn-submit').prop('disabled', false);
          } else {
            $('#btn-submit').prop('disabled', true);
          }
          return false;
        });
      })

    </script>
@endpush
