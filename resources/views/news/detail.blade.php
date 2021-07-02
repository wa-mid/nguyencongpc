@extends('layout.news')

@push('head')
	@if(!empty($post->meta_pixel))
		{!! $post->meta_pixel !!}
	@endif
@endpush

@section('content')

    <style type="text/css" media="screen">
        #post-detail .post-block-6 .thumbnail img {
         height: auto;
        }
    </style>
    <div id="content">
        <div class="container" id="post-detail">
            <div id="breadcrumbs"><span class=""><a href="{{url('/')}}">Home</a></span> <i class="fa fa-angle-right"></i>
                <span class=""><a href="{{url('tin-tuc')}}">Tin tức</a></span> <i class="fa fa-angle-right"></i>
                @if(isset($postCategory))
                    <span class="breadcrumb_last_link"><a href="{{$postCategory->getDetailLink()}}">{{$postCategory->name}}</a>
                @endif
            </span>
            </div>
            <div class="post-title">
                <h1>{{$post->title}}</h1>
            </div>
            <div class="post-time">
                <i class="fa fa-clock-o"></i>
                <span>{{date('d/m/Y',strtotime($post->published_at))}}</span>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="post-share">
                        <?php $url = str_replace('http://', 'https://', url()->full());?>
                        <a href="https://www.facebook.com/sharer.php?u={{$url}}" class="s-fb">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{$url}}" class="s-tw">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?url={{$url}}" class="s-linke">
                            <i class="fa fa-linkedin-square"></i>
                        </a>
                        <a href="https://www.pinterest.com/pin/create/bookmarklet/?pinFave=1&amp;url={{$url}}"class="s-pin">
                            <i class="fa fa-pinterest"></i>
                        </a>
                        <a href="https://www.blogger.com/blog_this.pyra?t&u={{$url}}&n={{$post->title}}"class="s-blogger">
                           <img src="https://nguyencongpc.vn/photos/shares/icon-blogger.jpg" alt="share blogger">
                        </a>
                         <div  class="zalo-share-button" data-href="" data-oaid="2360590838383636184" data-layout="4" data-color="blue" data-customize=false></div>
                    </div>
                    <div class="post-content">
                        <div class="content-inner ">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <style>body > iframe {height: 350px;}</style>
                    <div class="fb-comments" data-href="<?php echo url()->current();?>" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
                </div>
                <div class="col-md-4">
                    <div class="post-block-6">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>Bài viết liên quan</span></h3>
                        </div>
                        <div class="block-content">

                            <?php foreach ($homePosts as $item){?>
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

                    <div class="post-block-7">
                        <div class="block-heading">
                            <h3 class="block-title left"><span>Sản phẩm HOT</span></h3>
                        </div>

                        <div class="block-content">
                            <div class="box-slide" style="overflow:hidden;">
                                <div class="owl-carousel owl-theme" id="hot-product">
                                    @foreach($product_hot as $item)
                                        <div class="product-item item">
                                            <a href="{{$item->getDetailLink()}}">
                                                <div class="image">
                                                    <img src="{{$item->getImage(null, 300)}}" />
                                                </div>
                                                <p class="text">
                                                    <span class="name">{{$item->name}}</span>
                                                    <span class="new-price">{{Helper::formatMoney($item->getPriceLabel())}}</span>
                                                    <span class="old-price">{{Helper::formatMoney($item->getOldPriceLabel())}}</span>
                                                    {!! $item->getSaleLable() !!}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            /*--Fix top menu--*/
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if(scroll > 238){
                    $(".post-share").addClass('fixtop');
                }else{
                    $(".post-share").removeClass('fixtop');
                }
            });

            /*--Slide banner chính--*/
            $("#hot-product").owlCarousel({
                loop: true,
                nav: true,
                dots:false,
                items:1,
                autoplay:true,
                autoplayTimeout:3000,
                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            });
        })
    </script>
    <!-- Zalo -->
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
@endsection
