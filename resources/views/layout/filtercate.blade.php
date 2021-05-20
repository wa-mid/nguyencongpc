@if(isset($categoryFilters))

    <div class="block-filter-cate" id="boxFilterPC" data-url="{{isset($category) ? $category->getDetailLink() : url('san-pham')}}">
        <ul class="filter-pc-ul">
            @foreach($categoryFilters as $index => $filter)
				@if($index < 5)
					<li class="{{isset($productFilter[$filter['slug']]) ? 'active' : ''}}" data-category="{{$filter['slug']}}">
						<div class="header">
							<span>{{$filter['name']}}</span>
							<i class="fa fa-caret-down"></i>
						</div>
						<div class="body">
							@if(isset($filter['child']) && !empty($filter['child']))
								@foreach($filter['child'] as $child)
									<div class="flexed {{isset($productFilter[$filter['slug']]) && in_array($child['id'], $productFilter[$filter['slug']]) ? 'active' : ''}}" data-filter="{{$child['id']}}">
										<span>{{$child['name']}}</span>
									</div>
								@endforeach
							@endif
						</div>
					</li>
				@endif
            @endforeach
			@if(count($categoryFilters) > 5) 
				<li>
					<div class="header">
						<span>Bộ lọc khác</span>
						<i class="fa fa-caret-down"></i>
					</div>
					<div class="body">
						<ul class="more-menu">
							@foreach($categoryFilters as $index => $filter)
								@if($index >= 5)
									<li class="{{isset($productFilter[$filter['slug']]) ? 'active' : ''}}" data-category="{{$filter['slug']}}">
										<div class="header">
											<span>{{$filter['name']}}</span>
										</div>
										<div class="row">
											@if(isset($filter['child']) && !empty($filter['child']))
												@foreach($filter['child'] as $child)
													<div class="flexed {{isset($productFilter[$filter['slug']]) && in_array($child['id'], $productFilter[$filter['slug']]) ? 'active' : ''}}" data-filter="{{$child['id']}}">
														<span>{{$child['name']}}</span>
													</div>
												@endforeach
											@endif
										</div>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				</li>
			@endif
        </ul>
        <!--
        <div class="buttons">
            <span class="delete">Xóa bộ lọc</span>
            <span class="apply" id="btnFilterSubmit">Áp dụng</span>
        </div>
        -->
    </div>

    @push('bottom')
        <script>
            function applyFilterPC() {
                var filters = [];
                $("#boxFilterPC li .flexed.active").each(function() {
                    var category = $(this).closest('li').data('category');
                    if(filters[category]) {
                        filters[category].push($(this).data('filter'));
                    } else {
                        filters[category] = [];
                        filters[category].push($(this).data('filter'));
                    }
                });
                var url = $("#boxFilterPC").data('url');
                //console.log(filters);return false;
                if(filters) {
                    url += '?'+serialize(filters);
                }
                window.location = url;
            }
            $(document).ready(function () {
                $("#boxFilterPC li .flexed").click(function() {
                    $(this).toggleClass('active');
                    applyFilterPC();
                });

            })
        </script>
    @endpush
   
@endif