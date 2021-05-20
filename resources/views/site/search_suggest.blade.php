<div class="result-search">
	@if(count($tags) > 0)
	<div class="list-keywords">
		<p class="caption">Từ khóa gợi ý</p>
		<ul>
			@foreach($tags as $tag)
				<li>
					<a href="{{route('search')}}/?q={{urlencode($tag->name)}}">{{$tag->name}}</a>
				</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="list-products">
		<p class="caption">Sản phẩm gợi ý</p>
		<ul>
		    @if($result->isEmpty())
		        <ul><li class="search-item"><i>Không có kết quả phù hợp với từ khóa.</i></li></ul>
		    @else
		        @foreach($result as $item)
		            <li class="search-item">
		                <a href="{{$item->getDetailLink()}}">
		                    <img alt="{{$item->name}}" src="{{$item->getImage(426, 320)}}">
		                    <span class="name font-weight-bold">{{$item->name}}</span>
		                    <span class="price">{{Helper::formatMoney($item->getPriceLabel())}}</span>
		                </a>
		            </li>
		        @endforeach
		    @endif
		</ul>
	</div>
</div>

