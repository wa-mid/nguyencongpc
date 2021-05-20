@extends('layout.layout')

@section('content')
    <div id="content">
        <div class="container">
            <div id="profile-user" style="padding: 5px">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class='alert alert-success alert-dismissible'>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <span><i class="icon fa fa-info"></i> {{ $message }}</span>
                            </div>
                        @endif
                        @if ($error = Session::get('error'))
                            <div class='alert alert-danger alert-dismissible'>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <span><i class="icon fa fa-info"></i> {{$error}}</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-2"></div>
                    <div class="col-12 col-md-8">
                        <div class="caption">
                            <p>Thông tin liên hệ</p>
                        </div>
                        <i>Mọi thắc mắc và góp ý của khách hàng vui lòng liên hệ trực tiếp với chăm sóc khách hàng của chúng tôi bằng cách điền đầy đủ thông tin vào form bên dưới.</i>
                        <div style="margin-top: 30px" class="content">
                            <div>
                                <form method="POST" action="/lien-he">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group required">
                                        <label for="name">Họ tên </label>
                                        <input type="text" name="name" class="form-control" placeholder="Họ tên" required>
                                    </div>
                                    <div class="form-group required">
                                        <label for="email">Email </label>
                                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group required">
                                        <label for="phone">SĐT </label>
                                        <input type="text" name="phone" class="form-control" placeholder="SĐT" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội dung</label>
                                        <textarea class="form-control" name="content" rows="5"></textarea>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary ">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
