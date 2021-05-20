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
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif