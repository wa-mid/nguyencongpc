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
                                <strong>Chi nhánh</strong>
                                <select class="form-control" name="branchName">
									<option value="">Tất cả</option>
									<option value="Chi nhánh trung tâm" {{$user->branchName == 'Chi nhánh trung tâm' ? 'selected' : ''}}>Chi nhánh trung tâm</option>
									<option value="Chi Nhánh 2" {{$user->branchName == 'Chi Nhánh 2' ? 'selected' : ''}}>Chi Nhánh 2</option>
									<option value="176 Tân Phước - HCM" {{$user->branchName == '176 Tân Phước - HCM' ? 'selected' : ''}}>176 Tân Phước - HCM</option>
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
