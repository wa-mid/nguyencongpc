@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Tag &nbsp;&nbsp;
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <form method='get' id="form-filter-button" action='{{route("admin.tags.index")}}'>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" class="form-control" id="input_term" name="term" value="{{$filter['term']}}" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::select('suggest', array( '1' => 'Yes', '0' => 'No'), $filter['suggest'], array('class' => 'form-control', 'placeholder' => "Suggest")) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info margin-r-5">Filter</button>
                                <a href="{{route("admin.tags.index")}}" class="btn btn-success margin-r-5">Clear</a>
                            </div>
                            <!-- /.col -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Name</th>
                            <th class="text-center">Suggest</th>
                            <th class="text-center" width="280px">Action</th>
                        </tr>
                        @foreach ($data as $key => $tag)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $tag->name }}</td>
                                <td class="text-center">{{ $tag->suggest ? 'YES' : 'NO' }}</td>
                                <td class="text-center">
                                    @can('tag-edit')
                                        <a href="{{ route('admin.tags.edit',$tag->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                        @if($tag->suggest)
                                            <a href="{{ route('admin.tags.unSuggest',$tag->id) }}" title="Bỏ Suggest" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-check"></i></a>
                                        @else
                                            <a href="{{ route('admin.tags.suggest',$tag->id) }}" title="Suggest" class="btn btn-success btn-xs" type="submit"><i class="fa fa-check"></i></a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    <div class="box-tools pull-right">
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection