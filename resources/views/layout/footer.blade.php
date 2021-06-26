<?php
/**
 * Created by PhpStorm.
 * User: tavanchinh
 * Date: 9/9/19
 * Time: 12:32 PM
 */?>
<div id="footer">
    <div class="for-pc">
        <div class="floor-1">
            <div class="container">
                <div class="column">
                    <p>Thông tin chung</p>
                </div>
                <div class="column">
                    <p>Chính sách chung</p>
                </div>
                <div class="column">
                    <p>Hỗ trợ khách hàng</p>
                </div>
                <div class="column">
                    <p>Thanh toán an toàn</p>
                </div>
            </div>
        </div>
        <div class="floor-2">
            <div class="container">
                <div class="column">
                    <div class="menu">
                        {!! Helper::getOption('bottom_menu_genaral') !!}
                    </div>
                </div>
                <div class="column">
                    <div class="menu">
                        {!! Helper::getOption('bottom_menu_chinhsach') !!}
                    </div>
                </div>
                <div class="column">
                    <div class="menu">
                        {!! Helper::getOption('bottom_menu_hotrokh') !!}
                    </div>
                </div>
                <div class="column">
                    <div class="menu">
                        {!! Helper::getOption('bottom_menu_thanhtoan') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="floor-3">
            <div class="container">
         
                <div class="column column-50 info-company" style="width: 50%;">
                    <div>
                        {!! Helper::getOption('footer_text') !!}
                    </div>
                </div>
                <div class="column column-50" style="width: 50%;">
                    @if(Request::is('/'))
                        <h1 style="font-size: 14px;color: #fff;width: 400px;line-height: 2;text-align: justify;">PC, WORKSTATION - CPU – BỘ VI XỬ LÝ – MAINBROAD – BO MẠCH CHỦ – VGA – CARD MÀN HÌNH – CASE – VỎ MÁY TÍNH – MONITOR – MÀN HÌNH – PSU
                            NGUỒN MÁY TÍNH – RAM Ổ CỨNG HDD – SSD – GHẾ ALPHA – GAMER – PHỤ KIỆN
                        </h1>
                    @else
                        <p style="font-size: 14px;color: #fff;width: 400px;line-height: 2;text-align: justify;">PC, WORKSTATION - CPU – BỘ VI XỬ LÝ – MAINBROAD – BO MẠCH CHỦ – VGA – CARD MÀN HÌNH – CASE – VỎ MÁY TÍNH – MONITOR – MÀN HÌNH – PSU
                            NGUỒN MÁY TÍNH – RAM Ổ CỨNG HDD – SSD – GHẾ ALPHA – GAMER – PHỤ KIỆN
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="floor-5">
            <div class="container">
                <p>Bản quyền thuộc về nguyencongpc.vn</p>
            </div>
        </div>
    </div>
   @if(isset($bodyClass) && $bodyClass != 'page-product-detail')
        <!-- menu mobile -->
        <div class="only-mobile" >
            <ul class="menufix-footer">
                <li>
                    <a href="javascript:void(0)" onclick="toggleMenu()">
                        <i class="fa fa-windows" aria-hidden="true"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="/xay-dung-cau-hinh">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span >Build PC</span>
                    </a>
                </li>
                <li>
                    <a href="/gio-hang">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="count-item" id="order_count"></span>
                        <span class="text shopping">Giỏ hàng</span>
                    </a>
                </li>
                <li  data-toggle="modal" data-target="#modal-sbmenumobile">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <span>Thông tin</span>
                </li>
            </ul>
            <div class="floor-3">
                <p>CÔNG TY TNHH MÁY TÍNH NGUYỄN CÔNG</p>
            </div>
            <div class="floor-4">
                {!! Helper::getOption('footer_mobile_text') !!}
            </div>
            <div class="floor-5">
                <p>Bản quyền thuộc về nguyencong.vn</p>
                <div style="display: flex;">
                    <a href="http://online.gov.vn/CustomWebsiteDisplay.aspx?DocId=47540" style=" flex: 1; text-align: right;">
                        <img src="/images/logo_thong_bao.png" style="height: 35px;">
                    </a>
                    <a by="" class="dmca-badge" dmca.com="" href="https://www.dmca.com/Protection/Status.aspx?ID=55181dbf-c94f-4549-986b-f02024115eeb" protection="" style="width: 50%;text-align: left;margin-left: 10px;">
                        <img alt="Content" by="" dmca.com="" protection="" src="https://images.dmca.com/Badges/dmca-badge-w100-2x1-03.png?ID=55181dbf-c94f-4549-986b-f02024115eeb" style="height: 35px;">
                    </a>
                </div>
            </div>
         
        </div>
    @endif
   
</div>

<div class="socical-icons">
    <ul>

        <li >
            <a data-toggle="modal" data-target="#modal-contact" href="javascript:void(0)" title="Liên hệ với hotline">
                <i class="fa fa-phone"></i>
            </a>
        </li>
        <li class="for-pc">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-showroom" title="Hệ thống showroom">
                <i class="fa fa-location-arrow"></i>
            </a>
        </li>
        <li class="for-pc">
            <a href="https://facebook.com/Server.Workstation.Gaming.EditVideo" target="_blank" title="Fanpage của NguyenCongPC">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        <li class="for-pc">
            <a href="https://www.youtube.com/channel/UC3SOjMy1NZoBWzYk6bEZIaw" target="_blank" title="Kênh Youtube của NguyenCongPC">
                <i class="fa fa-youtube"></i>
            </a>
        </li>
    </ul>
    <div class="comment-fb">
        <a href="https://m.me/MAY.TINH.NGUYEN.CONG" target="_blank" title="Chat với tư nhân viên tư vấn">
            <i class="fa fa-comments-o"></i>
        </a>
    </div>
</div>


<div class="modal fade" id="modal-sbmenumobile" tabindex="-1" role="dialog" aria-labelledby="modal-sbmenumobile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="accounts">
                @if(Auth::check())
                    <div class="btn-account">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <a href="/thong-tin-ca-nhan">{{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}</a>
                        <a href="/logout">| Đăng xuất</a>
                    </div>
                @else
                    <div class="btn-account"><a href="javascipt:void(0)" id="btn-action-user">Đăng nhập / Đăng ký</a></div>
                @endif
            </div>
            <ul >
                <li class="ctmbtn-user">
                    <a >
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span >Điện thoại liên hệ</span> 
                    </a>
                </li>
                <li class="collapse-One" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    <a >Thông tin chung</a> 
                    <i class="fa fa-caret-down"></i>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        {!! Helper::getOption('bottom_menu_genaral') !!}
                        {!! Helper::getOption('bottom_menu_chinhsach') !!}
                    </div>
                </li>
                <li class="collapse-One"  data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <i class="fa fa-life-ring" aria-hidden="true"></i>
                    <span>Hỗ trợ khách hàng</span>
                    <i class="fa fa-caret-down"></i>
                    <div id="collapseFive" class="collapse"  aria-labelledby="headingOne" data-parent="#accordion">
                        {!! Helper::getOption('bottom_menu_thanhtoan') !!}
                        {!! Helper::getOption('bottom_menu_hotrokh') !!}
                    </div>
                </li>
                <li id="btn-maps">
                    <i class="fa fa-map-o" aria-hidden="true"></i>
                    <span >Hệ thống showroom</span>
                </li>
                <li>
                    <i class="fa fa-headphones" aria-hidden="true"></i>
                    <a href="tel:0981919999">CSKH : 098.191.9999</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- contacts -->
<div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="modal-contact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {!! Helper::getOption('support_menu') !!}
        </div>
    </div>
</div>
<!-- showrooms         -->
<div class="modal fade content_showrooms" id="modal-showroom" tabindex="-1" role="dialog" aria-labelledby="modal-showroom" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase font-weight-bold">Hệ thống showroom</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        {!! Helper::getOption('content_showrooms') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=862038067474115&autoLogAppEvents=1"></script>
<script>
    $(document).ready(function(){
        $('#btn-maps').click(function(){
            $(".modal").modal('hide');
            $("#modal-showroom").modal('show');
        });
        $('.btn-account').click(function(){
            $(".modal").modal('hide');
            $("#modal-user").modal('show');
        });
        $('.ctmbtn-user').click(function(){
            $(".modal").modal('hide');
            $("#modal-contact").modal('show');
        });
    });
</script>
