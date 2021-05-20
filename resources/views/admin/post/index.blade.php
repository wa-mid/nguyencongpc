@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Post &nbsp;&nbsp;
                @can('post-create')
                    <a href="{{route("admin.posts.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New Post</a>
                @endcan
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter" action='{{Request::url()}}'>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="input_term" name="term" value="{{$filter['term']}}" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="filter_category_id" name="category_id">
                                        <option value="">All</option>
                                        @foreach($allCategories as $category)
                                            <option value="{{$category->id}}" {{$filter['category_id'] == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.posts.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered post-table">
                        <tr>
                            <th>No</th>
                            <th>Tiêu đề</th>
                            <th>Chuyên mục</th>
                            <th>Lượng xem</th>
                            <th>Ngày xuất bản</th>
                            <th>Status</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $post)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{$post->category_name}}</td>
                                <td>{{ $post->views_count }}</td>
                                <td>{{ Helper::formatDateFromString($post->published_at, 'd/m/Y') }}</td>
                                <td>{{ $post->getStatusText()}}</td>
                                <td>
                                    <a href="{{ $post->getDetailLink() }}" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                    @can('post-edit')
                                        <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('post-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.posts.destroy', $post->id],'style'=>'display:inline']) !!}
                                            <button class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" type="submit"><i class="fa fa-times"></i></button>
                                            {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <div class="box-tools pull-right">
                        {!! urldecode(str_replace("/?","?",$data->appends(Request::all())->render())) !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection