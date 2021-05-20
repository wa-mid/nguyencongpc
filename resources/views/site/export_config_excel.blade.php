<table class="table">
    <tbody>
    <tr>
        <td style="width: 5px;"></td>
        <td style="width: 10px;"></td>
        <td style="width: 60px;"></td>
        <td style="width: 20px;"></td>
        <td style="width: 20px;"></td>
        <td style="width: 20px;"></td>
        <td style="width: 20px;"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><strong>CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNG</strong></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="width: 15px;height: 15px; text-align: right" colspan="2" rowspan="7"><img style="width: 100%" src="{{public_path('/images/logo-1.png')}}"></td>
    </tr>
    <tr>
        <td></td>
        <td>Đ/c: Số 190 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà Nội</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
	<tr>
        <td></td>
        <td>Đ/c 2: Số 52 Trần Phú - Hà Đông - Hà Nội</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Hotline: 097.111.3333</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Email: nguyencongcomputer.vn@gmail.com</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Website: nguyencongpc.vn</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>Fanpage: https://www.facebook.com/MAY.TINH.NGUYEN.CONG/</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;font-size: 22px"><strong>BÁO GIÁ</strong></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><strong>Tên khách hàng: </strong></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center; background-color: #1E64A9; color: #FFFFFF">Ngày</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><strong>Địa chỉ: </strong></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;">{{date('d/m/Y')}}</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><strong>Mã số thuế: </strong></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;">Đơn vị tiền: VNĐ</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>STT</strong></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>Tên sản phẩm</strong></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>Bảo hành</strong></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>Số lượng</strong></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>Đơn giá</strong></th>
        <th style="border: 1px solid #000000;text-align: center; background-color: #1E64A9; color: #FFFFFF;height: 20px"><strong>Thành tiền</strong></th>
    </tr>
    @foreach($result as $index => $product)
        <tr>
            <td></td>
            <td style="border: 1px solid #000000;text-align: center;height: 20px">{{$index+1}}</td>
            <td style="border: 1px solid #000000;text-align: left;height: 20px"><a href="{{url($product->slug)}}">{{$product->name}}</a></td>
            <td style="border: 1px solid #000000;text-align: right;height: 20px">{{number_format($product->warranty)}}</td>
            <td style="border: 1px solid #000000;text-align: right;height: 20px">{{number_format($product->quantity)}}</td>
            <td style="border: 1px solid #000000;text-align: right;height: 20px">{{($product->getPrice() > 0) ? $product->getPrice() : 'Liên hệ'}}</td>
            <td style="border: 1px solid #000000;text-align: right;height: 20px">{{($product->total > 0) ? $product->total : 'Liên hệ'}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td colspan="4"></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: left;height: 20px"><strong>Phí vận chuyển</strong></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: right;height: 20px"><strong>0</strong></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4"></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: left;height: 20px"><strong>Chi phí khác</strong></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: right;height: 20px"><strong>0</strong></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4"></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: left;height: 20px"><strong>Tổng tiền đơn hàng</strong></td>
        <td style="border: 1px solid #000000;background-color: #5294cb;text-align: right;height: 20px"><strong>{{ isset($saveBuildPc) ? $saveBuildPc->total : '0'}}</strong></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center" colspan="2"><strong>Người mua hàng</strong></td>
        <td style="text-align: center"><strong>Người bán hàng</strong></td>
        <td style="text-align: center"><strong>Kế toán</strong></td>
        <td style="text-align: center"><strong>Thủ kho</strong></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center" colspan="2">(Ký, họ tên)</td>
        <td style="text-align: center">(Ký, họ tên)</td>
        <td style="text-align: center">(Ký, họ tên)</td>
        <td style="text-align: center">(Ký, họ tên)</td>
    </tr>
    </tbody>
</table>

