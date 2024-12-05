@extends('admin.layout.master')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hisories as $history)
            <tr>
                <th scope="row">{{$history->id}}</th>
                <td>
                    @if(is_array($history->title))
                        @foreach($history->title as $item)
                            {{$item}}<br>
                        @endforeach
                    @else
                        {{$history->title}}
                    @endif
                </td>           
                <td>{{$history->price}}</td>
                <td><a href="{{url('/delete/' . $history->id)}}">delete</a></td>
            </tr>
        @endforeach                                        
    </tbody>
</table>
@endsection