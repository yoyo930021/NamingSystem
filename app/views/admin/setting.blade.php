@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <div class="page-header">
                <h1>系統設定</h1>
            </div>
            @if(Session::get('status')=="open")
                <div class="alert alert-success" role="alert">===開啟系統成功===</div>
            @endif
            @if(Session::get('status')=="stop")
                <div class="alert alert-success" role="alert">===關閉系統成功===</div>
            @endif
            <div class="btn-group" role="group" aria-label="">
                <a href="admin.setting.open" class="btn btn-default">開啟</a>
                <a href="admin.setting.stop" class="btn btn-default">關閉</a>
            </div>
        </div>

@stop
