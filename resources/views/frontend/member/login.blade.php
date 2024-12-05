@extends('frontend.layout.master')
@section('content')
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>Đăng nhập</h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="example-email" class="col-md-12">Email</label>
                <div class="col-md-12">
                    <input type="email" placeholder="abc@admin.com" class="form-control form-control-line" name="email"
                        id="example-email" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Password</label>
                <div class="col-md-12">
                    <input type="password" placeholder="password" name="password" class="form-control form-control-line"
                        value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">Login</button>
                    <p class="auth-link">Bạn chưa có tài khoản? <a href="{{url("/signup")}}">Đăng ký ngay</a></p>
                </div>
            </div>
        </form>
    </div><!--/sign up form-->
    @endsection