@extends('start.layout')

@section('contain')

<div class="jumbotron" id="start">
            <h1>Hello, world!</h1>
            <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <center>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">開始使用</a>
                </p>
            </center>
        </div>
        <div class="col-md-9">
            @foreach ($posts->$post )
            <div class="post">
                <h3><a href="#">{{{ $post->title }}}</a></h3>
                <div class="infor">Posted:{{{ $post->timeStamp }}} 作者：{{{ $post->author }}}</div>
                <p>{{{ $post->content }}}</p>
            </div>
            @endforreach
        </div>

        <div class="col-md-3">
            <li>
                <a href="#">
                    <p>管理登入</p>
                </a>
            </li>
        </div>

@stop
