@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <form method="post">
                <div class="page-header">
                    <h1>修改課程</h1>
                </div>
                <div class="form-group">
                    <label>課程名稱：</label>
                    <input type="text" name="subjectname" class="form-control" value="{{{$subject->name}}}"/>
                </div>
                <div class="form-group">
                    <label>老師：</label>
                    <select class="form-control" name="teacher">
                    @foreach($teachers as $teacher)
                        <option value="{{{$teacher->id}}}" {{{$subject->teacher_id==$teacher->id?'selected':''}}} >{{{$teacher->name}}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>班級：</label>
                    <select class="form-control" name="classchoose">
                        @foreach($classall as $classone)
                            <option value="{{{$classone->id}}}" {{{$subject->teacher_id==$classone->id?'selected':''}}} >{{{$classone->name}}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>是否啟用：</label>
                    <select class="form-control" name="enable">
                        @if($subject->enabled==1)
                            <option value="{{{$subject->enabled}}}" selected >啟用</option>
                            <option value="0">停用</option>
                        @else
                            <option value="{{{$subject->enabled}}}" selected >停用</option>
                            <option value="1">啟用</option>
                        @endif
                    </select>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input class="btn btn-primary btn-lg col-md-6" type="submit" value="送出" />
                <input type="reset" class="btn btn-primary btn-lg col-md-6" value="回復原本" />
            </form>
        </div>

@stop
