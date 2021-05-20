@extends('layout.layout')

@section('content')
    <div id="content">
        <div class="container">
            <div class="news-list">
                <div class="main-content">
                    <div class="left-content">
                        @include('layout.menu_news')
                    </div>
                    <div class="right-content">
                        <div class="breadcrumb for-pc">
                            <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                                <li itemprop="itemListElement" itemscope itemtype="{{url('/')}}">
                                    <a itemprop="item" href="{{url('/')}}">
                                        <span itemprop="name">Trang chủ</span></a>
                                    <meta itemprop="position" content="1" />
                                    <i class="fa fa-angle-double-right"></i>
                                </li>
                                <li itemprop="itemListElement" itemscope itemtype="{{$postCategory->getDetailLink()}}">
                                    <a itemprop="item" href="{{$postCategory->getDetailLink()}}">
                                        <span itemprop="name">{{$postCategory->name}}</span></a>
                                    <meta itemprop="position" content="3" />
                                </li>
                            </ol>
                        </div>
                        <div class="block">
                            <div class="head">
                                <p>{{$postCategory->name}}</p>
                            </div>

                            <div class="grid grid-two-on-mobile">
                                @foreach($posts as $item)
                                <div class="grid-item news-item">
                                    <a href="{{$item->getDetailLink()}}">
                                        <div class="image">
                                            <img src="{{$item->getImage(240,180)}}">
                                        </div>
                                        <p class="text">
                                            <span class="name">{{$item->title}}</span>
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

@endsection
