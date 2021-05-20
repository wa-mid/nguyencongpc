@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <!--Category Shop setting -->
            <h1>
                {{$contact->id ? 'Edit Contact' : 'New Contact'}} &nbsp;&nbsp;
                <a href="{{route("admin.contacts.index")}}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Admin Contact</a>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.layout.message')

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Contact</a></li>
                </ul>
                <div class="tab-content">
                    {!! Form::model($contact, ['method' => 'POST','route' => ['admin.contacts.edit', $contact->id]]) !!}
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Tên</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Tên','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Email</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>SĐT</strong>
                                    {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Nội dung</strong>
                                    {!! Form::textarea('content', null, array('placeholder' => 'Nội dung','id' => 'contact-content','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Ngày tạo</strong>
                                    {!! Form::text('created_at', null, array('placeholder' => 'Ngày tạo','class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
