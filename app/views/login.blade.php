@extends('start.layout')

@section('contain')

        <div class="col-md-4 col-md-offset-4">
            <form class="form-signin">
                <center><h2 class="form-signin-heading">管理登入</h2></center>
                <label class="sr-only" for="inputAccount">帳號</label>
                <input name="inputAccount" class="form-control" type="text" autofocus="" required="" placeholder="帳號"></input>
                <label for="inputPassword" class="sr-only">密碼</label>
                <input name="inputPassword" class="form-control" placeholder="請輸入密碼" required="" type="password"></input>
                <br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
            </form>
        </div>

@stop
