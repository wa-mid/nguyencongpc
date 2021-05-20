<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNG</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <META name="revisit-after" content="2 days"/>
    <META NAME="ROBOTS" CONTENT= "INDEX, FOLLOW"/>
    <META NAME="author" CONTENT= "CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNGI"/>
    <META NAME="distribution" content= "global"/>
    <style>
        .list_table {
            border-collapse:collapse;
        }
        .list_table td{border:solid 1px #aaa; padding:5px; text-algin:center; vertical-align:middle;}
        .cart_first_tr {
            background-color:#cccccc;
        }
        BODY, FORM, TABLE, TD, SPAN, DIV {
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;
        }
        .title a {
            color:#0000FF;
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            text-decoration:none;
        }
        .title a:hover {
            color:#0000FF;
            text-decoration:underline;
        }
    </style>
</head>
<body onload="exportImage()">
<div style="width: 700px;margin: 0 auto;">
    <div id="exportImg" >
        <table width="700">
            <tr>
                <td colspan="3" valign="top">
                    <a href="/"><img src="/images/logo-1.png" alt="Máy tính Nguyễn Công" style="width:100px;"/></a>
                </td>
                <td colspan="5" align="right" style="line-height: 19px;">
                    <b style="color: #007bff;font-size: 20px;">CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNG</b><br />
                    Địa chỉ: Số 377 - 379 Trương Định, Hoàng Mai, Hà Nội<br />
                    Địa chỉ 2: 52 Trần Phú - Hà Đông - Hà Nội<br>
                    Địa chỉ 3: 176 Tân Phước - Quận 10- TP Hồ Chí Minh<br>
                    Hotline: 097.111.3333 * Website: www.nguyencongpc.vn

                </td>
            </tr>
            <tr><td colspan="8"></td></tr>
            <tr>
                <td colspan="8" style="border-top: 4px double #ccc;;font-size:21px; font-weight:bold; text-align:center; padding:15px 0;">BẢNG BÁO GIÁ THIẾT BỊ</td>
            </tr>
        </table>

        <table><tr><td colspan="8">&nbsp;</td></tr></table>
        <table width="700">
            <tr>
                <td colspan="5" align="left"></td>
                <td colspan="3" align="right">
                    Ngày báo giá: <span id="price_time">{{date('d/m/Y H:i')}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="5" align="left"></td>
                <td colspan="3" align="right">
                    <i>Đơn vị tính: VNĐ</i>
                </td>
            </tr>
        </table>

        <div style="padding: 10px;"></div>

        <table width="700" class="list_table" border="1">
            <tr style="color: #ffffff; background-color:#007bff;">
                <td>STT</td>
                <td>Mã sản phẩm</td>
                <td colspan="2">Tên sản phẩm</td>
                <td>Bảo hành</td>
                <td>Số lượng</td>
                <td>Đơn giá</td>
                <td>Thành tiền</td>
            </tr>
            @foreach($listProducts as $index => $product)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$product->code}}</td>
                    <td colspan="2"><a href="/{{$product->slug}}">{{$product->name}}</a></td>
                    <td>{{$product->warranty}}</td>
                    <td>{{number_format($product->quantity)}}</td>
                    <td>{{($product->getPrice() > 0) ? Helper::formatMoney($product->getPrice()) : 'Liên hệ'}}</td>
                    <td>
                        {{($product->total > 0) ? Helper::formatMoney($product->total) : 'Liên hệ'}}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"></td>
                <td colspan="2" style="background:#b8cce4;">Phí vận chuyển</td>
                <td style="background:#b8cce4;">0</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="2" style="background:#b8cce4;">Chi phí khác</td>
                <td style="background:#b8cce4;">0</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="2" style="background:#b8cce4;">Tổng tiền đơn hàng</td>
                <td style="background:#b8cce4;">{{ isset($saveBuildPc) ? Helper::formatMoney($saveBuildPc->total) : '0'}}</td>
            </tr>
        </table>

        <table><tr><td colspan="8">&nbsp;</td></tr></table>

        <table width="700">
            <tr><td colspan="8"><b>Quý khách lưu ý:</b> Giá bán, khuyến mại của sản phẩm và tình trạng còn hàng có thể bị thay đổi bất cứ lúc nào mà không kịp báo trước</td></tr>
            <tr><td colspan="8">
                    Để biết thêm chi tiết, Quý khách vui lòng liên hệ NGUYENCONGPC qua HOTLINE: 098.191.9999 hoặc email: <a href="mailto:nguyencongpc.vn@gmail.com">nguyencongpc.vn@gmail.com</a>
                </td></tr>
            <tr><td colspan="8">Một lần nữa NGUYENCONGPC cảm ơn quý khách!</td></tr>
        </table>
    </div>
</div>

</body>
<script src="/js/dom-to-image.min.js"></script>
<script>
    function exportImage() {
        var node = document.getElementById('exportImg');

        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                document.body.appendChild(img);
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
    }

</script>
</html>
