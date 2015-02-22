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
            @foreach ($posts as $post)
            <div class="post">
                <h3><a href="#">{{{ $post->title }}}</a></h3>
                <div class="infor">Posted:{{{ $post->timeStamp }}} 作者：{{{ $post->author }}}</div>
                <p>{{{ $post->content }}}</p>
            </div>
            @endforeach
        </div>

        <div class="col-md-3">
            @if (Session::get('studentlogin')!=true)
                <form class="form-signin" method="POST">
                    <h2 class="form-signin-heading">學生登入</h2>
                    @if($settings->server_state==0)
                        <div class="alert alert-warning" role="alert">===系統未開放===</div>
                    @endif
                    @if(Session::get('error')=="#")
                        <div class="alert alert-warning" role="alert">===帳密錯誤===</div>
                    @endif
                    @if(Session::get('logout')=="#")
                        <div class="alert alert-success" role="alert">===登出成功===</div>
                    @endif
                    <label class="sr-only" for="inputAccount">帳號</label>
                    <input name="inputAccount" class="form-control" type="text" autofocus="" required="" placeholder="請輸入學號"></input>
                    <label for="inputPassword" class="sr-only">密碼</label>
                    <input name="inputPassword" class="form-control" placeholder="請輸入身份證後四碼" required="" type="password"></input>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
                </form>
            @else
                <li>
                    <a href="student">
                        <p>學生狀態</p>
                    </a>
                </li>
            @endif
            <li>
                <a href="teacher">
                    <p>老師登入</p>
                </a>
            </li>
            <li>
                <a href="admin">
                    <p>管理登入</p>
                </a>
            </li>
        </div>

@stop
