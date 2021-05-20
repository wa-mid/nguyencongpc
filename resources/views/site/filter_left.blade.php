@if(!empty($filterChild))
    <ul class="">
        @foreach($filterChild as $index => $item)
            <li class="" data-category="{{$item['slug']}}">
                <div class="head">
                    <span>{{$item['name']}}</span>
                    <i class="fa fa-caret-up"></i>
                </div>
                <div class="body">
                    @if(isset($item['child']) && !empty($item['child']))
                        @foreach($item['child'] as $child)
                            <div class="flex filter-item {{in_array($child['id'], $allFilterIds) ? 'active' : ''}}" data-filter="{{$child['id']}}">
                                <span>{{$child['name']}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
@endif
