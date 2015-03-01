@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <form method="post">
                <div class="page-header">
                    <h1>新增修改學生</h1>
                </div>
                <div class="form-group">
                    <label>學生名稱：</label>
                    <input type="text" name="name" class="form-control" value="{{{$student->name or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>座號：</label>
                    <input type="text" name="number" class="form-control" value="{{{$student->seat or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>帳號：</label>
                    <input type="text" name="account" class="form-control" value="{{{$student->account or ''}}}"/>
                </div>
                <div class="form-group">
                    <label>密碼：</label>
                    <input type="password" name="password" class="form-control" value="{{{isset($student->password)?'oooooooo':''}}}"/>
                </div>
                <div class="form-group">
                    <label>班級：</label>
                    <select class="form-control" name="classname">
                    @foreach($classall as $classone)
                        <option value="{{{$classone->id}}}" {{{$student->class_id or ''==$classone->id?'selected':''}}} >{{{$classone->name}}}</option>
                    @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input class="btn btn-primary btn-lg col-md-6" type="submit" value="送出" />
                <input type="reset" class="btn btn-primary btn-lg col-md-6" value="回復原本" />
            </form>
        </div>

@stop
