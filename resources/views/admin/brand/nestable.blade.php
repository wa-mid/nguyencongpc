<ol class="dd-list">
    @foreach ($brands as $brand)
        @if ($children = $brand['child'])
            <li class="dd-item dd3-item" data-id="{{$brand['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <strong>{!! $brand['name'] !!}</strong>
                    <span class="pull-right">
                        <a href="{{route('admin.brands.edit', $brand['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('admin.brands.destroy', $brand['id'])}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </span>
                </div>
                @include( 'admin.brand.nestable', array('brands' => $children))
            </li>
        @else
            <li class="dd-item dd3-item" data-id="{{$brand['id']}}">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <span>{!!$brand['name'] !!}</span>
                    <span class="pull-right">
                        <a href="{{route('admin.brands.edit', $brand['id'])}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
						{!! Form::open(['method' => 'DELETE','route' => ['admin.brands.destroy', $brand['id']],'style'=>'display:inline']) !!}
							<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
						{!! Form::close() !!}
                    </span>
                </div>
            </li>
        @endif
    @endforeach
</ol>