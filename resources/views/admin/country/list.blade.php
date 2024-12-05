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
            @foreach($country as $ct)
            <tr>
                <th scope="row">{{$ct->id}}</th>                                      
                <td>{{$ct->name}}</td>
                <td><a href="{{url('/delete/'.$ct->id)}}">delete</a></td>                                        
            </tr>
            @endforeach                                        
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/add_ct')}}" ><button id="button" style="color:white; background-color:green; float:left">Add Blog</button></a>
                    </td>
                </tr>
            </tfoot>
    </table>
@endsection