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
            @foreach($brands as $brand)
            <tr>
                <th scope="row">{{$brand->id}}</th>                                      
                <td>{{$brand->name}}</td>
                <td><a href="{{url('/delete/'.$brand->id)}}">delete</a></td>                                        
            </tr>
            @endforeach                                        
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/add_brand')}}" ><button id="button" style="color:white; background-color:orange; float:left">Add Brand</button></a>
                    </td>
                </tr>
            </tfoot>
    </table>
@endsection