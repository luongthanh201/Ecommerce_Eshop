@extends('admin.layout.master')
@section('content')
    <table class="table">
        <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>                                               
                    <th scope="col">Action</th>                                               
                </tr>
        </thead>
        <tbody>
            @foreach($category as $cate)
            <tr>
                <th scope="row">{{$cate->id}}</th>                                      
                <td>{{$cate->name}}</td>
                <td><a href="{{url('/delete/'.$cate->id)}}">delete</a></td>                                        
            </tr>
            @endforeach                                        
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/add_cate')}}" ><button id="button" style="color:white; background-color:orange; float:left">Add Category</button></a>
                    </td>
                </tr>
            </tfoot>
    </table>
@endsection