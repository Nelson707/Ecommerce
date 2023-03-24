<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<div class="hero_area">
    <!-- header section starts -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->
</div>
<!-- why section -->
@include('home.why')
<!-- end why section -->

<!-- arrival section -->
@include('home.new_arrival')
<!-- end arrival section -->

<!-- product section -->
@include('home.products')
<!-- end product section -->


{{--Comment and reply--}}

<div style="width: 70%; margin: 2% auto">

    <h1 style="font-size: 30px; padding-top: 20px; padding-bottom: 20px">Comments</h1>

    <form action="{{ url('add_comment') }}" method="post">

        @csrf

        <textarea style="height: 150px; width: 600px" placeholder="Leave a comment..." name="comment"></textarea>

        <input type="submit" class="btn btn-primary" value="Comment">
    </form>

    <div>
        <h1 style="font-size: 30px; padding-bottom: 20px">All Comments</h1>

        @foreach($comment as $comment)
            <div style="margin-top: 20px">
                <hr>

                <b>{{ $comment->name }}</b>
                <p>{{ $comment->comment }}</p>

                <a style="color: blue" href="javascript:void(0);" onclick="reply(this)" data-CommentId="{{ $comment->id }}">Reply</a>


            </div>

            @foreach($reply as $Reply)
                @if($Reply->comment_id==$comment->id)

                    <div style="padding-left: 3%; padding-bottom: 10px; padding-top: 10px">

                        <b>{{ $Reply->name }}</b>
                        <p style="color: grey; padding-bottom: 5px">Replying to: {{ $comment->name }}</p>
                        <p>{{ $Reply->reply }}</p>


                        <a style="color: blue" href="javascript:void(0);" onclick="reply(this)" data-CommentId="{{ $comment->id }}">Reply</a>

                    </div>
                @endif
            @endforeach


        @endforeach

    </div>

    <div style="display: none" class="replyDiv">
        <form action="{{ url('add_reply') }}" method="post">

            @csrf

            <input type="text" id="commentId" name="commentId" hidden="">

            <textarea style="height: 100px; width: 500px" placeholder="Leave a reply.." name="reply"></textarea>

            <button type="submit" class="btn btn-warning">Reply</button>



            <a href="javascript:void(0);" class="btn" onclick="reply_close(this)">Close</a>
        </form>
    </div>

</div>





{{--end Comment and reply--}}

{{--custom js--}}

<script type="text/javascript">
    function reply(caller)
    {
        document.getElementById('commentId').value=$(caller).attr('data-CommentId');
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
    }

    function reply_close()
    {
        $('.replyDiv').hide();
    }
</script>




<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>

{{--end custom js--}}


<!-- subscribe section -->
@include('home.subscribe')
<!-- end subscribe section -->
<!-- client section -->
@include('home.client')
<!-- end client section -->
<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>
