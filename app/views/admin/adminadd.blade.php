@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <form method="post">
                <div class="page-header">
                    <h1>新增修改管理員</h1>
                </div>
                <div class="form-group">
                    <label>管理名稱：</label>
                    <input type="text" name="name" class="form-control" value="{{{$admin->name or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>帳號：</label>
                    <input type="text" name="account" class="form-control" value="{{{$admin->account or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>密碼：</label>
                    <input type="password" name="password" class="form-control" value="{{{isset($admin->password)?'oooooooo':''}}}"/>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input class="btn btn-primary btn-lg col-md-6" type="submit" value="送出" />
                <input type="reset" class="btn btn-primary btn-lg col-md-6" value="回復原本" />
            </form>
        </div>

@stop
