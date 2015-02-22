@extends('admin.layout')

@section('contain')

        <div class="col-md-4 col-md-offset-4">
            <form class="form-signin"  method="POST">
                <center><h2 class="form-signin-heading">管理登入</h2></center>
                @if(Session::get('error')=="#")
                    <div class="alert alert-warning" role="alert">===帳密錯誤===</div>
                @endif
                @if(Session::get('logout')=="#")
                    <div class="alert alert-success" role="alert">===登出成功===</div>
                @endif
                <label class="sr-only" for="inputAccount">帳號</label>
                <input name="inputAccount" class="form-control" type="text" autofocus="" required="" placeholder="帳號"></input>
                <label for="inputPassword" class="sr-only">密碼</label>
                <input name="inputPassword" class="form-control" placeholder="請輸入密碼" required="" type="password"></input>
                <br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
            </form>
        </div>

@stop
