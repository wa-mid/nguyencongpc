@extends('layout.layout')
@section('content')
    <div id="content">
		<div class="container">
			<div class="product-category product-filter" id="category-page">
				<div class="breadcrumb for-pc">
					<ol itemscope itemtype="http://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemtype="http://schema.org/Thing" itemprop="item" href="{{url('/')}}">
								<span itemprop="name">Trang chủ</span></a>
							<meta itemprop="position" content="1"/>
							<i class="fa fa-angle-double-right"></i>
						</li>
						<li>
							<strong>Từ khóa: {{$tag->name}}</strong>
						</li>
					</ol>
				</div>
				
				<div class="main-content">
					<div class="left-content left-content-cate left">
						@include('layout.menu')
					</div>
					<div class="right-content">
						<div class="main-product">
							<div class="head">
								<h1>Tìm thấy {{$totalResult}} sản phẩm liên quan đến "<strong>{{$tag->name}}</strong>"</h1>
							</div>
							<div class="list-product workstation-product grid-two-on-mobile">
								@if(count($result) > 0)
									@foreach($result as $item)
										<div class="product-item" data-id="{{$item->id}}">
											<a href="{{$item->getDetailLink()}}">
												<div class="image">
													<img src="{{$item->getImage(426, 320)}}" />
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
								@else
									<div style="padding:60px 0;">
									<p class="text-center">Không tìm thấy sản phẩm.</p>
									</div>
								@endif
							</div>
							<div class="div-pagination">
								{!! urldecode(str_replace("/?","?",$result->onEachSide(1)->appends(Request::all())->render())) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

@endsection

