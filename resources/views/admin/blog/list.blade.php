@extends('admin.layout.master')
@section('content')
<table class="table">
        <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>                                               
                    <th scope="col">Image</th>                                               
                    <th scope="col">Description</th>                                               
                    <th scope="col">Action</th>                                               
                </tr>
        </thead>
        <tbody>
            @foreach($blog as $bl)  
            <tr>
                <th scope="row">{{$bl->id}}</th>                                      
                <td>{{$bl->title}}</td>
                <td>{{$bl->image}}</td>
                <td>{{$bl->description}}</td>
                <td>
                    <a href="{{url('/edit_bl/'.$bl->id)}}">edit</a>
                    <br>
                    <a href="{{url('/delete_bl/'.$bl->id)}}">delete</a>   
                </td>                                        
                                                     
            </tr>
            @endforeach                                        
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/add_bl')}}" ><button id="button" style="color:white; background-color:green; float:left">Add Blog</button></a>
                    </td>
                </tr>
            </tfoot>
    </table>
@endsection