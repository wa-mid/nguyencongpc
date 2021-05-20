@extends('layout.layout')

@push('head')
	@if(!empty($post->meta_pixel))
		{!! $post->meta_pixel !!}
	@endif
@endpush

@section('content')
    <div id="content">
        <div class="container">
            <div class="news-list">
                <div class="main-content">
                    <div class="left-content">
                        @include('layout.menu_news')
                        <div class="news-special for-pc mgy10">
                            <div class="head">
                                <p>Tin tức nổi bật</p>
                            </div>
                            <div class="list-news">
                                <div class="box-slide">
                                    <div class="owl-carousel owl-theme" id="news-special-slide">
                                        @foreach($homePosts->split(3) as $items)
                                            <div class="item">
                                                @foreach($items as $item)
                                                    <div class="news-item">
                                                        <a href="{{$item->getDetailLink()}}">
                                                            <img src="{{$item->getImage(300)}}" alt="{{$item->title}}">
                                                            <div class="text">
                                                                <i class="fa fa-forward"></i>
                                                                <span>{{$item->title}}</span>
                                                                <div class="time">
                                                                    <i class="fa fa-calendar-o"></i> {{Helper::formatDateFromString($item->published_at, 'd/m/Y')}} &nbsp;&nbsp;&nbsp;
                                                                    <i class="fa fa-clock-o"></i> {{Helper::formatDateFromString($item->published_at, 'H:i')}}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="view-all">
                                    <a href="/category/tin-tuc-noi-bat/" class="view-all">Xem tất cả</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="breadcrumb for-pc">
                            <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/')}}">
                                        <span itemprop="name">Trang chủ</span></a>
                                    <meta itemprop="position" content="1"/>
                                    <i class="fa fa-angle-double-right"></i>
                                </li>
                                @if($postCategory)
                                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a itemtype="http://schema.org/Thing" itemprop="item" href="{{$postCategory->getDetailLink()}}">
                                        <span itemprop="name">{{$postCategory->name}}</span></a>
                                    <meta itemprop="position" content="2"/>
                                    <i class="fa fa-angle-double-right"></i>
                                </li>
                                @endif
                                <li>
                                    <strong>{{$post->title}}</strong>
                                </li>
                            </ol>
                        </div>
                        <h1 class="product-name for-pc">{{$post->title}}</h1>
                        <div class="news-content">
                            {!! $post->content !!}
                        </div>
                        <div class="fb-comments" data-href="{{$post->getDetailLink()}}" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>

                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
