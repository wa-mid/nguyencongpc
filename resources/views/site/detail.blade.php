@extends('layout.layout')

@section('content')
    <div id="content">
    <div class="container">
        <div class="product-detail">
            <div class="main-info">
                <div class="breadcrumb for-pc">
                    <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn">
                            <a itemprop="item" href="https://nguyencongpc.vn">
                                <span itemprop="name">Trang chủ</span></a>
                            <meta itemprop="position" content="1" />
                            <i class="fa fa-angle-double-right"></i>
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn/san-pham.html">
                            <a itemprop="item" href="https://nguyencongpc.vn/san-pham.html">
                                <span itemprop="name">Sản phẩm</span></a>
                            <meta itemprop="position" content="2" />
                            <i class="fa fa-angle-double-right"></i>
                        <li itemprop="itemListElement" itemscope itemtype="https://nguyencongpc.vn/san-pham.html">
                            <a itemprop="item" href="https://nguyencongpc.vn/san-pham.html">
                                <span itemprop="name">Bộ máy sử dụng chip AMD</span></a>
                            <meta itemprop="position" content="3" />
                            <i class="fa fa-angle-double-right"></i>
                        </li>

                        <li itemprop="itemListElement" itemscope>
                            <span itemprop="name">Bộ PC AMD Ryzen 7 3700X / Ram 32Gb / GTX 1660 6G</span>
                            <meta itemprop="position" content="4" />
                        </li>
                    </ol>
                </div>
                <h1 class="product-name for-pc">Bộ PC AMD Ryzen 7 3700X / Ram 32Gb / GTX 1660 6G</h1>
                <div class="left-content">
                <div class="product-images">
                    <div class="box-slide">
                        <div class="owl-carousel owl-theme" id="product-images">
                            <div class="item">
                                <img alt="" src="/images/25.jpg" />
                            </div>
                            <div class="item">
                                <img alt="" src="/images/26.jpg" />
                            </div>
                            <div class="item">
                                <img alt="" src="/images/27.jpg" />
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="right-content">
                    <div class="price">
                        <span class="sale">20%</span>
                        <span class="old-price">67.800.000 đ</span>
                        <p class="new-price">61.800.000 đ</p>
                        <p class="buy">
                            Mua ngay, giao tận nơi
                            <span>Xem hàng, không mua không sao</span>
                        </p>
                        <span class="status">
                        <label>Tình trạng: </label>
                        Còn hàng
                    </span>
                        <span class="warr">
                        <label>Bảo hành: </label>
                        24 tháng
                    </span>
                        <a class="call" href="tel:0971113333">
                            Gọi điện thoại đặt mua:
                            <span>097.111.3333</span>
                        </a>
                    </div>
                    <div class="product-support clearfix mgy10">
                        <ul class="support">
                            <li><i class="fa fa-check-circle"></i> Hỗ trợ tư vấn lắp đặt trong nội thành Hà Nội.</li>
                            <li><i class="fa fa-check-circle"></i> Hỗ trợ mua hàng trả góp.</li>
                            <li><i class="fa fa-check-circle"></i> Hỗ trợ cài đặt các phần mềm đồ họa.</li>
                            <li><i class="fa fa-check-circle"></i> Được tham gia các chương trình giảm giá sốc.</li>

                        </ul>
                    </div>
                    <div class="buttons">
                        <div class="left">
                            <div class="rate">
                                <input type="hidden" id="product-rating" class="rating-tooltip-manual" data-filled="fa fa-star fa-2x" data-empty="fa fa-star-o fa-2x" value="4"/>
                            </div>
                        </div>
                        <div class="right">
                            <div class="fb-like"
                                 data-href="https:nguyencongpc.vn"
                                 data-layout="button_count"
                                 data-action="like"
                                 data-ref=""
                                 data-share="true"
                                 data-size="large"
                                 data-show-faces="false">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="left-content">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab-home" role="tab" aria-controls="home"
                           aria-selected="true">Giới thiệu sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab-profile" role="tab" aria-controls="profile"
                           aria-selected="false">Thông số kỹ thuật</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="media-tab" data-toggle="tab" href="#tab-media" role="tab" aria-controls="contact"
                           aria-selected="false">Video</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rating-tab" data-toggle="tab" href="#tab-rating" role="tab" aria-controls="contact"
                           aria-selected="false">Đánh giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="comment-tab" data-toggle="tab" href="#tab-comment" role="tab" aria-controls="contact"
                           aria-selected="false">Bình luận</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                        Bộ PC AMD Ryzen 7 3700X / Ram 16Gb / VGA GTX 1050Ti 4G  : bộ máy chuyên dụng cho đồ họa , render thiết kế với những phần mềm như : 3DsMax , Sketchup , Revit , Maya , Cinema 4D , được đánh giá cao về hiệu năng trên giá thành .

                        CPU AMD Ryzen 7 3700X : Ryzen 7 3700x chạy trên nền tảng socket AM4 – là một trong những mã CPU được nhiều người mong đợi nhất trong list cpu Ryezn 3000 Series. Cùng có 8 nhân/16 luồng như Ryzen 7 3800X , hiệu năng render đem lại được so sánh ngang với Intel Core I9 9900K trong khi có mức giá rẻ hơn tương đối .

                    </div>
                    <div class="tab-pane fade"  id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-bored" width="100%">
                            <tbody>
                            <tr>
                                <td><strong>TT</strong></td>
                                <td><strong>MÃ HÀNG</strong></td>
                                <td><strong>TÊN HÀNG</strong></td>
                                <td><strong>THỜI HẠN BẢO HÀNH</strong></td>
                            </tr>
                            <tr>
                                <td><strong>1</strong></td>
                                <td><strong>CPU</strong></td>
                                <td><strong>CPU AMD <span style="color: #ff0000;">Ryzen 7 3700X</span> (3.6 – 4.4Ghz / 8 core 16 thread / socket AM4)</strong></td>
                                <td><strong>36 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>2</strong></td>
                                <td><strong>MAIN</strong></td>
                                <td><strong>ASUS Prime <span style="color: #ff0000;">X570</span> P</strong></td>
                                <td><strong>36 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>3</strong></td>
                                <td><strong>RAM</strong></td>
                                <td><strong>Corsair Vengence Pro 16Gb/3000 (2*8)</strong></td>
                                <td><strong>36 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>4</strong></td>
                                <td><strong>SSD</strong></td>
                                <td><strong>APACER AS340 240GB 2.5” SATA III</strong></td>
                                <td><strong>36 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>5</strong></td>
                                <td><strong>HDD</strong></td>
                                <td><strong>Western 1Tb 7200RPM</strong></td>
                                <td><strong>24 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>6</strong></td>
                                <td><strong>VGA</strong></td>
                                <td><b>Asus Ceberus GTX 1050Ti 4G</b></td>
                                <td><strong>36 THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>7</strong></td>
                                <td><strong>NGUỒN</strong></td>
                                <td><strong>PSU Cooler Master MWE 750 WHITE 230V 750w</strong></td>
                                <td><strong>36&nbsp;THÁNG</strong></td>
                            </tr>
                            <tr>
                                <td><strong>8</strong></td>
                                <td><strong>CASE</strong></td>
                                <td><strong>XIGMATEK Poseidon</strong></td>
                                <td><strong>12 THÁNG</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-media" role="tabpanel" >
                        <iframe width="100%" height="550px" src="https://www.youtube.com/embed/kYh94oAKQTg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="tab-pane fade" id="tab-rating" role="tabpanel">
                        Đang cập nhật
                    </div>
                    <div class="tab-pane fade" id="tab-comment" role="tabpanel">
                        <div class="fb-comments" data-href="https:nguyencongpc.vn" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
                    </div>
                </div>
                <div class="only-mobile botton-action">
                    <ul class="action-1">
                        <li>
                            <a href="#"><img src="/images/mobile/m-chat.svg"></a>
                        </li>
                        <li>
                            <a href="#"><img src="/images/mobile/m-call.svg"></a>
                        </li>
                        <li>
                            <a href="#"><img style="width: 33px;margin:3px" src="/images/mobile/build.svg"></a>
                        </li>
                    </ul>
                    <div class="action-2">
                        <a href="#">Thêm vào giỏ hàng</a>
                    </div>
                    <div class="action-3">
                        <a href="#">Mua ngay</a>
                    </div>
                </div>
            
            </div>
            <div class="right-content">

                <div class="product-related">
                    <div class="head">
                        <p>Sản phẩm liên quan</p>
                    </div>

                    <div class="list-product">
                        <?php for($i= 1; $i<7;$i++){?>
                        <div class="product-item" data-id="11874">
                            <a href="http://localhost:2070/11874">
                                <div class="image">
                                    <img src="https://nguyencongpc.vn/wp-content/uploads/8fbfef59f9e71db944f6.jpg">
                                </div>
                                <p class="text">
                                    <span class="name">BỘ PC CORE I9 9900K / RAM 32GB / VGA GTX 1660TI 6G</span>
                                    <span class="new-price">39.990.000</span>
                                    <span class="old-price">42.390.000</span>
                                    <span class="sale">-6%</span>
                                </p>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    
    <script>
    $(document).ready(function () {
        $("#product-images").owlCarousel({
            loop: false,
            nav: true,
            dots:true,
            items:1,
            navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
        });
    })

    </script>
    
@endsection
