<ol class="dd-list">
    @foreach ($filters as $filter)
        @if ($children = $filter['child'])
            <li class="dd-item dd3-item" data-id="{{$filter['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <strong>{!! $filter['name'] !!}</strong>
                    <span class="pull-right">
                        <a href="{{route('admin.filters.edit', $filter['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('admin.filters.destroy', $filter['id'])}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                </div>
                @include( 'admin.filter.nestable', array('filters' => $children))
            </li>
        @else
            <li class="dd-item dd3-item" data-id="{{$filter['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <span>{!!$filter['name'] !!}</span>
                    <span class="pull-right">
                        <a href="{{route('admin.filters.edit', $filter['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('admin.filters.destroy', $filter['id'])}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                </div>
            </li>
        @endif
    @endforeach
</ol>