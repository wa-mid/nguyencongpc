@extends('layout.news')

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="special-news">
                        <a href="#">
                            <div class="thumbnail">
                                <img alt="" src="/images/1.jpg">
                            </div>
                        </a>
                        <div class="post-content">
                            <div class="post-category">
                                <a href="#">Công nghệ</a>
                            </div>
                            <div class="post-title">
                                <h2>
                                    <a href="#">Người dùng “ưu ái” iPhone 11, Apple sẽ cắt giảm số lượng của iPhone 11 Pro và 11 Pro Max</a>
                                </h2>
                            </div>
                            <div class="post-time">
                                <i class="fa fa-clock-o"></i>
                                <span>14:02 27/10/2019</span>
                            </div>
                        </div>
                    </div>

                    <div class="hot-news post-block-1">
                        <?php $list = [
                            ['title' => 'AMD đầu tư vào Blender với tư cách nhà tài trợ chính thức','image'=>'2.jpg'],
                            ['title' => 'Micron phá kỉ lục ép xung RAM với kết quả 5726 MHz','image'=>'3.jpg'],
                            ['title' => 'Chính sách bảo hành đặc biệt cho sản phẩm mang nhãn hiệu Kingfast','image'=>'4.png'],
                            ['title' => 'Micron phá kỉ lục ép xung RAM với kết quả 5726 MHz','image'=>'3.jpg'],
                            ['title' => 'Người dùng “ưu ái” iPhone 11, Apple sẽ cắt giảm số lượng của iPhone 11 Pro và 11 Pro Max','image'=>'5.jpg']
                        ];?>
                        <div class="owl-carousel owl-theme" id="news-hot">
                            <?php foreach($list as $value){?>
                            <div class="item">
                                <a href="#">
                                    <img src="/images/<?=$value['image']?>">
                                </a>
                                <a href="#">
                                    <p class="post-title">
                                        <?=$value['title']?>
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>14:02 27/10/2019</span>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-block-2">
                        <div class="block-heading">
                            <h3 class="block-title"><span>BÀI VIẾT <strong>MỚI NHẤT</strong></span></h3>
                        </div>
                        <div class="block-content">
                            <?php foreach($list as $value){?>
                            <div class="item">
                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <a href="#" title="<?=$value['title']?>">
                                    <p class="post-title">
                                        <?=$value['title']?>
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>14:02 27/10/2019</span>
                                </div>
                                <div class="post-view">
                                    <i class="fa fa-eye"></i>
                                    <span>14</span>
                                </div>
                                <div class="post-sapo">
                                    <p>Micron vừa mới lập kỉ lục chưa từng có trong giới ép xung RAM, vượt qua kỉ lục trước đó...</p>
                                </div>


                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="post-block-3">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>TIN <strong>CÔNG NGHỆ</strong></span></h3>
                            <a class="view-more right" href="#">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <div class="block-content">
                            <?php
                            $i = 0;
                            foreach($list as $value){
                            $i++;
                            if($i > 4) break;
                            ?>
                            <div class="item">
                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <a href="#" title="<?=$value['title']?>">
                                        <p class="post-title">
                                            <?=$value['title']?>
                                        </p>
                                    </a>
                                    <div class="post-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>14:02 27/10/2019</span>
                                    </div>
                                    <div class="post-view">
                                        <i class="fa fa-eye"></i>
                                        <span>14</span>
                                    </div>
                                    <div class="post-sapo">
                                        <p>Micron vừa mới lập kỉ lục chưa từng có trong giới ép xung RAM, vượt qua kỉ lục trước đó...</p>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-block-4">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>TIN <strong>NỔI BẬT</strong></span></h3>
                        </div>
                        <div class="block-content">
                            <?php
                            $i = 0;
                            foreach($list as $value){
                            $i++;
                            ?>
                            <div class="item">
                                <?php if($i == 1){?>
                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <?php }?>
                                <div class="post-info">
                                    <div class="rank">
                                        <span>0<?php echo $i?></span>
                                    </div>
                                    <a href="#" title="<?=$value['title']?>">
                                        <p class="post-title">
                                            <?=$value['title']?>
                                        </p>
                                    </a>
                                    <div class="post-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>14:02 27/10/2019</span>
                                    </div>
                                    <div class="post-view">
                                        <i class="fa fa-eye"></i>
                                        <span>14</span>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="post-block-3">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>REVIEW <strong>SẢN PHẨM</strong></span></h3>
                            <a class="view-more right" href="#">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                        </div>
                        <div class="block-content">
                            <?php
                            $i = 0;
                            foreach($list as $value){
                            $i++;
                            if($i > 3) break;
                            ?>
                            <div class="item">
                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <a href="#" title="<?=$value['title']?>">
                                        <p class="post-title">
                                            <?=$value['title']?>
                                        </p>
                                    </a>
                                    <div class="post-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>14:02 27/10/2019</span>
                                    </div>
                                    <div class="post-view">
                                        <i class="fa fa-eye"></i>
                                        <span>14</span>
                                    </div>
                                    <div class="post-sapo">
                                        <p>Micron vừa mới lập kỉ lục chưa từng có trong giới ép xung RAM, vượt qua kỉ lục trước đó...</p>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-block-2">
                        <div class="block-heading">
                            <h3 class="block-title left"><span><strong>GAMES</strong></span></h3>
                        </div>
                        <div class="block-content">
                            <?php
                            $i = 0;
                            foreach($list as $value){
                            $i++;
                            ?>
                            <div class="item">

                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <a href="#" title="<?=$value['title']?>">
                                        <p class="post-title">
                                            <?=$value['title']?>
                                        </p>
                                    </a>
                                    <div class="post-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>14:02 27/10/2019</span>
                                    </div>
                                    <div class="post-view">
                                        <i class="fa fa-eye"></i>
                                        <span>14</span>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php $list = [
                    ['title' => 'Kết quả bốc thăm trúng thưởng tại NguyenCongPC 190 Lê Thanh Nghị','image'=>'6.jpg'],
                    ['title' => 'Chính sách bảo hành đặc biệt cho sản phẩm nhãn hiueje Kingfast','image'=>'7.png'],
                    ['title' => 'Chương trình khuyến mãi giờ vàng - giá sốc','image'=>'9.jpg'],
                    ['title' => 'Chương trình khuyến mãi mừng ngày phụ nữ Việt Nam 20-10','image'=>'9.jpg'],
                    ['title' => 'Chương trình khuyến mãi Checkin - Nhận Quà','image'=>'10.jpg'],
                    ['title' => 'Chương trình khuyến mãi Siêu Flash Sale 10.10','image'=>'11.png']
                ];?>
                <div class="col-md-12">
                    <div class="post-block-5 post-sale">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>TIN <strong>KHUYẾN MÃI</strong></span></h3>
                        </div>
                        <div class="block-content">
                            <?php
                            $i = 0;
                            foreach($list as $value){
                            $i++;
                            ?>
                            <div class="item">

                                <div class="thumbnail">
                                    <a href="#" title="<?=$value['title']?>">
                                        <img alt="<?=$value['title']?>" src="/images/<?=$value['image']?>">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <a href="#" title="<?=$value['title']?>">
                                        <p class="post-title">
                                            <?=$value['title']?>
                                        </p>
                                    </a>
                                    <div class="post-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>14:02 27/10/2019</span>
                                    </div>
                                    <div class="post-view">
                                        <i class="fa fa-eye"></i>
                                        <span>14</span>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
