@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <form method="post">
                <div class="page-header">
                    <h1>新增修改老師</h1>
                </div>
                <div class="form-group">
                    <label>老師名稱：</label>
                    <input type="text" name="name" class="form-control" value="{{{$teacher->name or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>帳號：</label>
                    <input type="text" name="account" class="form-control" value="{{{$teacher->account or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>密碼：</label>
                    <input type="password" name="password" class="form-control" value="{{{isset($teacher->password)?'oooooooo':''}}}"/>
                </div>
                <div class="form-group">
                    <label>班級：</label>
                    <select class="form-control" name="classname">
                        <option value="0">無班級</option>
                    @foreach($classall as $classone)
                        <option value="{{{$classone->id}}}" {{{$teacher->class_id or ''==$classone->id?'selected':''}}} >{{{$classone->name}}}</option>
                    @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input class="btn btn-primary btn-lg col-md-6" type="submit" value="送出" />
                <input type="reset" class="btn btn-primary btn-lg col-md-6" value="回復原本" />
            </form>
        </div>

@stop
