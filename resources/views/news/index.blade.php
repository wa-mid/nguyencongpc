@extends('layout.news')

@section('content')
<?php $first = isset($list_tin_moi_nhat[0]) ? $list_tin_moi_nhat[0] : [];
unset($list_tin_moi_nhat[0]);
?>
<style type="text/css" media="screen">
    @media (min-width: 1024px) {
        .box-news {
            width: 100%;
            position: relative;
            padding: 15px;
        }
        .special-news {
            width: 65%;
            margin-right: 27px;
            min-height: 450px;
            position: relative;
            float: left;
        }
        .special-news .thumbnail {
            height: 450px;
        }
        .block-content .item img {
            -webkit-transition: 0.4s ease;
            transition: 0.4s ease;
        }
        .block-content .item img:hover {
            -webkit-transform: scale(1.03);
            transform: scale(1.03);
        }
        .box-news .block-heading {
            position: absolute;
            width: 31%;
            right: 26px;
            /* padding-bottom: 15px; */
        }
        .box-news .block-content .item {
            width: 19%;
            float: left;
            margin-bottom: 20px;
            min-height: 290px;
            overflow: hidden;
        }
        .box-news .block-content .item:nth-child(1),
        .box-news .block-content .item:nth-child(2),
        .box-news .block-content .item:nth-child(3) {
            width: 31%;
            min-height: 125px;
            max-height: 125px;
            overflow: hidden;
        }
        .special-news .thumbnail img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
        .box-news .block-content>.item:nth-child(1) {
            margin-top: 44px;
        }
        .box-news .block-content .item:nth-child(1) .thumbnail,
        .box-news .block-content .item:nth-child(2) .thumbnail,
        .box-news .block-content .item:nth-child(3) .thumbnail {
            width: 40%;
            float: right;
        }
        .box-news .block-content .item:nth-child(4),
        .box-news .block-content .item:nth-child(5),
        .box-news .block-content .item:nth-child(6),
        .box-news .block-content .item:nth-child(7) {
            margin-right: 10px;
        }
        .special-news .post-content {
            position: absolute;
            bottom: 0;
            width: 100%;
            left: 0;
            padding: 10px 20px;
            background: rgba(0, 0, 0, .3);
        }
        .special-news .item-content a p {
            color: #fff;
            font-size: 16px;
            margin: 0;
        }
        .special-news .item-content .post-time,
        .special-news .item-content .post-view {
            color: #fff;
        }
        .special-news .item-content .post-sapo {
            display: none;
        }
    }
    @media (max-width: 768px) {
        .box-news {
            padding: 0 15px;
        }
        .box-news .item .thumbnail {
            width: 31%;
            float: left;
            margin-right: 10px;
        }
        .box-news .item {
            margin-bottom: 15px;
        }
        .box-news .post-title {
            margin-top: 0;
        }
        .box-news .post-sapo {
            display: inline-block;
        }
    }
</style>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="box-news">
                <div class="block-heading">
                    <h3 class="pt-2 block-title"><span>BÀI VIẾT MỚI NHẤT</span></h3>
                </div>
                <div class="special-news">
                    <a href="{{$first->getDetailLink()}}" title="{{$first->title}}">
                        <div class="thumbnail">
                            <img alt="{{$first->title}}" src="{{$first->getImage(900,506)}}">
                        </div>
                    </a>
                    <div class="post-content">
                        <div class="post-title">
                            <h2>
                                <a href="{{$first->getDetailLink()}}" title="{{$first->title}}">{{$first->title}}</a>
                            </h2>
                        </div>
                        <div class="post-time">
                            <i class="fa fa-clock-o"></i>
                            <span>{{date('H:i - d/m/Y',strtotime($first->published_at))}}</span>
                        </div>
                    </div>
                </div>
                <div class="news-right">
                    <div class="block-content">
                        @foreach($list_tin_moi_nhat as $item)
                        <div class="item">
                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                <p class="post-title">
                                    {{$item->title}}
                                </p>
                            </a>
                            <div class="post-time">
                                <i class="fa fa-clock-o"></i>
                                <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                            </div>
                            <div class="post-view">
                                <i class="fa fa-eye"></i>
                                <span>{{number_format($item->views_count,0,',','.')}}</span>
                            </div>
                            <div class="post-sapo">
                                <p>{!!Helper::cutString(strip_tags($item->content),90)!!}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="post-block-8">
                    <div class="block-heading">
                        <h2 class="block-title left"><span>VIDEO YOUTUBE NGUYỄN CÔNG PC</span></h2>
                    </div>
                    <div class="block-content">
                        @foreach($videos as $item)

                        <div class="item click-to-play" data-title="{{$item->title}}" data-vid="{{$item->get_youtube_video_ID($item->link)}}">
                            <div class="thumbnail">
                                <a href="javascript:void(0)" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getThumbnailYT($item->link)}}">
                                </a>
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="post-info">
                                <a href="#" title="{{$item->title}}">
                                    <p class="post-title">
                                        {{$item->title}}
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{date('H:i - d/m/Y',strtotime($item->created_at))}}</span>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        <div id="modal-play" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modal-play" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="video" id="ifembed"></div>
                                    <div class="video-title" id="video-title-play"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="post-block-3">
                    <div class="block-heading">
                        <h1 class="block-title left"><span>TIN CÔNG NGHỆ</span></h1>
                        <a class="view-more right" href="/category/tin-tuc">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="block-content">

                        @foreach($list_tin_moi_nhat as $item)
                        <div class="item">
                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            <div class="post-info">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <p class="post-title">
                                        {{$item->title}}
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                                </div>
                                <div class="post-view">
                                    <i class="fa fa-eye"></i>
                                    <span>{{number_format($item->views_count,0,',','.')}}</span>
                                </div>
                                <div class="post-sapo">
                                    <p>{!!Helper::cutString(strip_tags($item->content),90)!!}</p>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div class="block-loadmore ">
                        <a href="/category/tin-tuc" class="" data-load="Xem thêm"> Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-block-4">
                    <div class="block-heading">
                        <h3 class="block-title left"><span>TIN NỔI BẬT</span></h3>
                    </div>
                    <div class="block-content">
                        @foreach($list_tin_tuc_noi_bat as $j => $item)
                        <div class="item">
                            @if($j == 0)
                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            @endif
                            <!-- <div class="rank">
                                <span>0<?php echo $j ?></span>
                            </div> -->
                            <div class="post-info">

                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <p class="post-title">
                                        {{$item->title}}
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                                </div>
                                <div class="post-view">
                                    <i class="fa fa-eye"></i>
                                    <span>{{number_format($item->views_count,0,',','.')}}</span>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="post-block-3">
                    <div class="block-heading">
                        <h3 class="block-title left"><span>REVIEW SẢN PHẨM</span></h3>
                        <a class="view-more right" href="/category/tin-tuc-review">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                    </div>
                    <div class="block-content">
                        @foreach($list_tin_review as $item)
                        <div class="item">
                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            <div class="post-info">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <p class="post-title">
                                        {{$item->title}}
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                                </div>
                                <div class="post-view">
                                    <i class="fa fa-eye"></i>
                                    <span>{{number_format($item->views_count,0,',','.')}}</span>
                                </div>
                                <div class="post-sapo">
                                    <p>{!!Helper::cutString(strip_tags($item->content),90)!!}</p>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-block-2">
                    <div class="block-heading">
                        <h4 class="block-title left"><span>Hướng dẫn</span></h4>
                    </div>
                    <div class="block-content">
                        @foreach($list_tin_huong_dan as $item)
                        <div class="item">
                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                <p class="post-title">
                                    {{$item->title}}
                                </p>
                            </a>
                            <div class="post-time">
                                <i class="fa fa-clock-o"></i>
                                <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                            </div>
                            <div class="post-view">
                                <i class="fa fa-eye"></i>
                                <span>{{number_format($item->views_count,0,',','.')}}</span>
                            </div>
                            <div class="post-sapo">
                                <p>{!!Helper::cutString(strip_tags($item->content),90)!!}</p>
                            </div>


                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="post-block-5 post-sale">
                    <div class="block-heading">
                        <h4 class="block-title left"><span>TIN KHUYẾN MÃI</span></h4>
                    </div>
                    <div class="block-content">
                        @foreach($list_tin_khuyen_mai as $item)
                        <div class="item">

                            <div class="thumbnail">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <img alt="{{$item->title}}" src="{{$item->getImage(350,196)}}">
                                </a>
                            </div>
                            <div class="post-info">
                                <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                    <p class="post-title">
                                        {{$item->title}}
                                    </p>
                                </a>
                                <div class="post-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{date('H:i - d/m/Y',strtotime($item->published_at))}}</span>
                                </div>
                                <div class="post-view">
                                    <i class="fa fa-eye"></i>
                                    <span>{{number_format($item->views_count,0,',','.')}}</span>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div class="block-loadmore clearfix">
                        <a href="/category/tin-tuc-khuyen-mai" class="" data-load="Xem thêm"> Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(".click-to-play").click(function() {
            $this = $(this);
            $vid = $this.attr('data-vid');
            $title = $this.attr('data-title');
            $html = '<iframe src="https://www.youtube.com/embed/' + $vid + '?version=3&amp;rel=0&amp;controls=1&amp;showinfo=1&amp;autoplay=1&amp;loop=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>'
            $("#ifembed").html($html);
            $("#video-title-play").html('<p>' + $title + '</p>');
            $("#modal-play").modal();
        });

        $('#modal-play').on('hidden.bs.modal', function(e) {
            $("#ifembed").html('');
        })
    })
</script>
@endsection
