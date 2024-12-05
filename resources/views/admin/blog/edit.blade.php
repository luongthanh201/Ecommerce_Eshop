@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-body">
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
<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title" value="{{$blog->title}}">
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="example-email">Description </label>
        <textarea type="text"  class="form-control" name="description">{{$blog->description}}</textarea>    
    </div>
    <div class="form-group">
        <label>Content</label>
        <textarea type="text" class="form-control" name="content" id="editor1" >{{$blog->content}}</textarea>
    </div>  
    <button type="submit" name="xx" class="" id="" style="color:white; background-color:green; float:left; margin: 10px">Update Blog</button>             
</form>
        </div>
    </div>
</div>
@endsection                        