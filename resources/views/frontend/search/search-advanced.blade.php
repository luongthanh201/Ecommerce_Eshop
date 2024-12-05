@extends('frontend.layout.master')
@section('content')
<div class="container">
    <h2>Advanced Search</h2>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-exclamation-triangle"></i> Alert!</h4>
            {{ session('error') }}
        </div>
    @endif
    <form action="" method="POST" style="width:100%; display:flex;">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter product name">
        </div>
        <div class="form-group">
           <select class="form-control" id="price" name="price" >
                <option value="">choose price</option>
                <option value="0-100000"> <=100000 </option>
                <option value="100000-300000"> 100000-300000 </option>
                <option value="300000-700000"> 300000-700000 </option>
           </select>
        </div>
        <div class="form-group">        
            <select class="form-control" id="category" name="category">
                <option value="">Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            
            <select class="form-control" id="brand" name="brand">
                <option value="">Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" id="status" name="status">
                <option value="">Status</option>
                <option value="available">New</option>
                <option value="unavailable">Sale</option>
            </select>
        </div>       
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection

