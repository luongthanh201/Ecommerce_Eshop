@extends('frontend.layout.master')

@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">

            <h3>{{$detail->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Luong Thanh</li>
                    <li><i class="fa fa-clock-o"></i> {{$detail->created_at->format('H:i')}}</li>
                    <li><i class="fa fa-calendar"></i> {{$detail->created_at->format('M d, Y')}}</li>
                </ul>
                <div class="rate">
                    <div class="vote">
                        <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                        <span class="rate-np">{{$average}}</span>
                    </div>
                </div>
            </div>
            <a href="">
                <img src="{{ asset('upload/product/' . $detail->image)}}" alt="{{ $detail->title }}">
            </a>
            <p>{{$detail->description}}</p>
        </div>
        <div class="pagination-area">
            @if ($prev)
                <a href="{{$prev->id}}" class="btn btn-primary">Previous</a>
            @endif
            @if ($next)
                <a href="{{$next->id}}" class="btn btn-primary">Next</a>
            @endif
        </div>
    </div>
    <div class="response-area">
        <h2> RESPONSES</h2>
        <ul class="media-list">
            @foreach ($comments as $cmt)           
                <li class="media" id="{{$cmt['id']}}">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('upload/user/' . $cmt['avatar_user'])}}" alt=""
                            style="width: 70px; height: 100px;">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$cmt['name_user']}}</li>
                            <li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($cmt['created_at']))  }}</li>
                            <li><i class="fa fa-calendar"></i>{{date('M d, Y', strtotime($cmt['created_at'])) }}</li>
                        </ul>
                        <p>{{$cmt['cmt']}}</p>
                        <a class="btn btn-primary reply" href="#cmt"><i class="fa fa-reply"></i>Reply</a>
                    </div>
                </li>
            @endforeach         
            @foreach ($cmtCon as $reply)
            
                <li class="media second-media" style="margin-left: 30px;">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{asset('upload/user/' . $cmts['avatar_user'])}}" alt="">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{$cmts['name_user']}}</li>
                            <li><i class="fa fa-clock-o"></i>{{date('h:i a', strtotime($reply['created_at'])) }}</li>
                            <li><i class="fa fa-calendar"></i>{{ date('M d, Y', strtotime($reply['created_at'])) }}</li>
                        </ul>
                        <p>{{$cmts['cmt']}}</p>
                        <a class="btn btn-primary " href=""><i class="fa fa-reply"></i>Replay</a>
                    </div>
                </li>
               
            @endforeach

        </ul>
    </div><!--/Response-area-->
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a replay</h2>
                <form method="post" id="cmt">
                    @csrf
                    <div class="text-area">
                        <div class="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <textarea name="message" rows="11"></textarea>
                        <input type="hidden" value="0" name="level" class="level" />
                        <button type="submit" class="btn btn-primary" href="">post comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/Repaly Box-->
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.ratings_stars').hover(
            function () {
                $(this).prevAll().addBack().addClass('ratings_hover');
            },
            function () {
                $(this).prevAll().addBack().removeClass('ratings_hover');
            }
        );

        $('.ratings_stars').click(function () {
            var checkLogin = "{{ Auth::check() }}";
            if (checkLogin) {
                var rate = $(this).find('input').val();
                alert(rate);
                $(this).prevAll().addBack().addClass('ratings_over');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/blog/rate/ajax') }}",
                    data: {
                        rate: rate,
                        id_blog: '{{ $detail->id }}'
                    },
                    success: function (data) {
                        console.log(data);
                    },
                });
            } else {
                alert("Vui lòng đăng nhập để đánh giá!!!");
                return false;
            }
        });

        $('.reply').click(function (e) {
            var commentId = $(this).closest("li").attr('id');
            $('input.level').val(commentId);
        });

        // Xử lý form bình luận
        $('#cmt').submit(function (e) {
            e.preventDefault();
            var isCheckLogin = "{{ Auth::check() }}";
            if (isCheckLogin) {
                var cmt = $('textarea').val();
                var level = $('input.level').val();              
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/blog/cmt/ajax') }}",
                    data: {
                        cmt: cmt,
                        id_blog: '{{ $detail->id }}',
                        level: level
                    },
                    success: function (res) {
                        var data = res.data;
                        // console.log(data.id);
                        var html = '';
                        if (data.level == 0) {
                            html = `<li class="media" id="${data.id}">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="upload/user/${data.avatar_user}" alt="" style="width: 70px; height: 100px;">
                                    </a>
                                    <div class="media-body">
                                        <ul class="sinlge-post-meta">
                                            <li><i class="fa fa-user"></i>${data.name_user}</li>
                                            <li><i class="fa fa-clock-o"></i>${new Date().toLocaleTimeString()}</li>
                                            <li><i class="fa fa-calendar"></i>${new Date().toLocaleDateString()}</li>
                                        </ul>
                                        <p>${data.cmt}</p>
                                        <a class="btn btn-primary reply" href="#"><i class="fa fa-reply"></i>Reply</a>
                                    </div>
                                </li>`;
                            $(".media-list").append(html);
                        } else {
                            html = `<li class="media second-media" id="${data.id}" style="margin-left:30px">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="upload/user/${data.avatar_user}" alt="" style="width: 70px; height: 100px;">
                                    </a>
                                    <div class="media-body">
                                        <ul class="sinlge-post-meta">
                                            <li><i class="fa fa-user"></i>${data.name_user}</li>
                                            <li><i class="fa fa-clock-o"></i>${new Date().toLocaleTimeString()}</li>
                                            <li><i class="fa fa-calendar"></i>${new Date().toLocaleDateString()}</li>
                                        </ul>
                                        <p>${data.cmt}</p>
                                        <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Reply</a>
                                    </div>
                                </li>`;
                            $("li#${data.id}").append(html);
                        }
                    }
                });
            } else {
                alert("Vui lòng đăng nhập để bình luận!!!");
            }
        });
    });

</script>
@endsection