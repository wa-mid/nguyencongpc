@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$user->id ? 'Edit User' : 'New User'}} &nbsp;&nbsp;
                <a href="{{route("admin.users.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin User</a>
                @if($user->id)
                    <a href="{{route("admin.users.create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> New User</a>
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')
            <div class="box no-border">
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::model($user, ['method' => 'POST','route' => $user->id ? ['admin.users.edit', $user->id] : 'admin.users.create']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                            </div>
                        </div>
						<div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Chi nh??nh</strong>
                                <select class="form-control" name="branchName">
									<option value="">T???t c???</option>
									<option value="Chi nh??nh trung t??m" {{$user->branchName == 'Chi nh??nh trung t??m' ? 'selected' : ''}}>Chi nh??nh trung t??m</option>
									<option value="Chi Nh??nh 2" {{$user->branchName == 'Chi Nh??nh 2' ? 'selected' : ''}}>Chi Nh??nh 2</option>
									<option value="176 T??n Ph?????c - HCM" {{$user->branchName == '176 T??n Ph?????c - HCM' ? 'selected' : ''}}>176 T??n Ph?????c - HCM</option>
								</select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
