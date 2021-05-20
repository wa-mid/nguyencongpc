@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                Admin Contact &nbsp;&nbsp
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding" style="overflow: auto;">
                    <table class="table table-bordered contact-table">
                        <tr>
                            <th>No</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Ngày tạo</th>
                            <th width="120px">Action</th>
                        </tr>
                        @foreach ($data as $key => $contact)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{ Helper::formatDateFromString($contact->created_at, 'd/m/Y H:m')}}</td>
                                <td>
                                    @can('contact-edit')
                                        <a href="{{ route('admin.contacts.edit',$contact->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    @endcan
                                    @can('contact-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.contacts.destroy', $contact->id],'style'=>'display:inline']) !!}
                                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
                                            {!! Form::close() !!}
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