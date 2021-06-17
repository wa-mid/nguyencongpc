@extends('layout.news')
@section('content')
    <div id="content">
        <?php if (Request::segment(2) == 'tin-tuc'): ?>
            <h1 style="display: none;"> Tin tức công nghệ </h1>
        <?php elseif(Request::segment(2) == 'tin-tuc-noi-bat'): ?>
            <h1 style="display: none;"> Tin tức công nghệ nổi bật</h1>
        <?php elseif(Request::segment(2) == 'tin-tuc-review'): ?>
            <h1 style="display: none;"> Review công nghệ </h1>
        <?php elseif(Request::segment(2) == 'kien-thuc-may-tinh'): ?>
            <h1 style="display: none;"> Kiến thức máy tính </h1>
        <?php elseif(Request::segment(2) == 'phan-mem-do-hoa'): ?>
            <h1 style="display: none;"> Phần mềm đồ họa </h1>
        <?php elseif(Request::segment(2) == 'phan-mem-van-phong'): ?>
            <h1 style="display: none;"> Phần mềm văn phòng </h1>
        <?php elseif(Request::segment(2) == 'tin-tuc-khuyen-mai'): ?>
            <h1 style="display: none;"> Tin tức khuyến mại </h1>

        <?php endif ?>
        <div class="container" id="filter-page">
            <?php if(count($posts) > 0) {?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="highlight-news">
                            <?php
                            $i=0;
                            foreach($posts as $item){?>
                            <div class="item">
                                <div class="thumbnail">
                                    <a href="{{$item->getDetailLink()}}" title="{{$item->title}}">
                                        <img alt="{{$item->title}}" src="{{$item->getImage(640,480)}}">
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
                            <?php
                            $i++;
                            unset($posts[$i]);
                            if($i > 4) break;
                            }?>
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-8">
                        <div class="post-block-3">

                            <div class="block-content">

                                <?php foreach($posts as $item){?>
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
                                <?php
                                unset($posts[$i]);
                                $i++;
                                if($i > 10) break;

                                }?>
                            </div>
                        </div>
                        <div class="" style="margin: 10px 0;">
                            {!! $posts->onEachSide(1)->appends(Request::all())->render() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="post-block-2">
                            <div class="block-heading">
                                <h2 class="block-title"><span>CÓ THỂ BẠN SẼ THÍCH</span></h2>
                            </div>
                            <div class="block-content">
                                <?php foreach($posts as $item){?>
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
                                <?php
                                unset($posts[$i]);
                                $i++;
                                if($i > 16) break;

                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{
                echo '<div style="text-align:center;height:900px; line-height:400px;font-size:30px">Dữ liệu đang cập nhật</div>';

            }?>



        </div>
    </div>
@endsection
