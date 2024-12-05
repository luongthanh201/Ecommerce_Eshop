@extends('frontend.layout.master')
@section('content')
<div class="col-sm-3">
    @include('frontend.layout.account-menu');
</div>
<div class="col-sm-9">
    <h2 class="title text-center">Update user</h2>
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
            <label class="col-md-12">Full Name</label>
            <div class="col-md-12">
                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" name="name"
                    value="{{$member->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="example-email" class="col-md-12">Email</label>
            <div class="col-md-12">
                <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line"
                    name="email" id="example-email" value="{{$member->email}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Password</label>
            <div class="col-md-12">
                <input type="password" name="password" class="form-control form-control-line"
                    value="{{$member->password}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Phone No</label>
            <div class="col-md-12">
                <input type="text" placeholder="" class="form-control form-control-line" name="phone"
                    value="{{$member->phone}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Message</label>
            <div class="col-md-12">
                <textarea rows="5" class="form-control form-control-line"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12">Select Country</label>
            <div class="col-sm-12">
                <select class="form-control form-control-line" name="country">
                    @foreach($country as $ct)
                        <option value="{{$ct->id}}">{{$ct->name}}</option>
                    @endforeach                                          
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Avatar</label>
            <div class="col-md-12">
                <input type="file" placeholder="" class="form-control form-control-line" name="avatar"
                    value="{{$member->name}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Update Profile</button>
            </div>
        </div>
    </form>
</div>

@endsection