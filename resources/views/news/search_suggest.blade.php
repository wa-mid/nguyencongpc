<ul>
    @if($result->isEmpty())
        <ul><li class="search-item"><i>Không có kết quả phù hợp với từ khóa.</i></li></ul>
    @else
        @foreach($result as $item)
            <li class="search-item">
                <a href="{{$item->getDetailLink()}}">
                    <img alt="{{$item->title}}" src="{{$item->getImage(200, 150)}}">
                    <span class="news-title">{{$item->title}}</span>
                    <span class="news-time"> <i class="fa fa-clock-o"></i> {{date('d/m/Y',strtotime($item->published_at))}} </span>
                </a>
            </li>
        @endforeach
    @endif
</ul>