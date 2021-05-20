@extends('layout.news')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="post-block-3">
                        <div class="block-heading">
                            <h1>Kết quả tìm kiếm cho "{{$term}}"</h1>
                        </div>
                        <div class="block-content">

                            <?php foreach($result as $item){?>
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

                            }?>
                        </div>
                        <div class="block-loadmore ">
                            <a href="/category/tin-tuc" class="" data-load="Xem thêm"> Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-block-6">
                        <div class="block-heading">
                            <h2 class="block-title left"><span>Bài viết <strong>liên quan</strong></span></h2>
                        </div>
                        <div class="block-content">

                            <?php foreach ($list_tin_tuc_noi_bat as $item){?>
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
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
