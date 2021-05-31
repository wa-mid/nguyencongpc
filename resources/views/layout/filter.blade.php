@if(isset($categoryFilters))
<div class="block block-filter" id="boxFilter" data-url="{{isset($category) ? $category->getDetailLink() : url('san-pham')}}">
    <div class="head head-filter">
        <span class="left">
            <i class="fa fa-filter"></i>
            Bộ lọc
        </span>
        <span class="right only-mobile">
            <i class="fa fa-close btn-close-filter"></i>
        </span>
    </div>
    <div class="filter-content">
        <ul class="">
            @foreach($categoryFilters as $filter)
            <li class="{{isset($productFilter[$filter['slug']]) ? 'active' : ''}}" data-category="{{$filter['slug']}}">
                <div class="head">
                    <span>{{$filter['name']}}</span>
                    <i class="fa fa-caret-up"></i>
                </div>
                <div class="body">
                    @if(isset($filter['child']) && !empty($filter['child']))
                        @foreach($filter['child'] as $child)
                            <div class="flex {{isset($productFilter[$filter['slug']]) && in_array($child['id'], $productFilter[$filter['slug']]) ? 'active' : ''}}" data-filter="{{$child['id']}}">
                                <span>{{$child['name']}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
        <div class="buttons">
            <a href="{{isset($category) ? $category->getDetailLink() : url('san-pham')}}"><span  class="delete">Xóa bộ lọc</span></a>
            <span class="apply" id="btnFilterSubmit">Áp dụng</span>
        </div>
    </div>
    
</div>
@push('bottom')
    <script>
        function serialize(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + obj[p].join(','));
                }
            return str.join("&");
        }
        function applyFilter() {
            var filters = [];
            $("#boxFilter li .flex.active").each(function() {
                var category = $(this).closest('li').data('category');
                if(filters[category]) {
                    filters[category].push($(this).data('filter'));
                } else {
                    filters[category] = [];
                    filters[category].push($(this).data('filter'));
                }
            });
       
            var url = $("#boxFilter").data('url');
            if(filters) {
                url += '?'+serialize(filters);
            }
            url += "&sort=" + $('#sort-select option:selected').val();
            window.location = url ;
        }
        $(document).ready(function () {
            $(".block-filter .head").click(function(){
                $(this).parent().toggleClass("active");
            });
            $("#boxFilter li .flex").click(function() {
                $(this).toggleClass('active');
            });
            $("#btnFilterSubmit").click(function() {
                applyFilter();
            });
        })
    </script>
@endpush
@endif