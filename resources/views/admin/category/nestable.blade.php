<ol class="dd-list">
    @foreach ($categories as $category)
        @if ($children = $category['child'])
            <li class="dd-item dd3-item" data-id="{{$category['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <strong>{!! $category['name'] !!}</strong>
                    <span class="pull-right">
                        <a href="{{route('admin.categories.edit', $category['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('admin.categories.destroy', $category['id'])}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                </div>
                @include( 'admin.category.nestable', array('categories' => $children))
            </li>
        @else
            <li class="dd-item dd3-item" data-id="{{$category['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <span>{!!$category['name'] !!}</span>
                    <span class="pull-right">
                        <a href="{{route('admin.categories.edit', $category['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('admin.categories.destroy', $category['id'])}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                </div>
            </li>
        @endif
    @endforeach
</ol>