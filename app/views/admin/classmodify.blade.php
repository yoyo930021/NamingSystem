@extends('admin.layout')

@section('contain')

        <div class="col-md-12">
            <form method="post">
                <div class="page-header">
                    <h1>修改班級</h1>
                </div>
                <div class="form-group">
                    <label>班級名稱：</label>
                    <input type="text" name="classname" class="form-control" value="{{{$classone->name}}}"/>
                </div>
                <div class="form-group">
                    <label>老師：</label>
                    <select class="form-control" name="teacher">
                    @foreach($teachers as $teacher)
                        <option value="{{{$teacher->id}}}" {{{$classone->teacher_id==$teacher->id?'selected':''}}} >{{{$teacher->name}}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>學生：(請按Ctrl選擇)</label>
                    <select class="form-control" multiple size="20" name="student[]">
                        @foreach($students as $student)
                            <option value="{{{$student->id}}}"
                                @foreach($classstudents as $classstudent)
                                    @if($classstudent->id==$student->id)
                                        selected
                                    @endif
                                @endforeach
                                >
                                {{{$student->name}}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input class="btn btn-primary btn-lg col-md-6" type="submit" value="送出" />
                <input type="reset" class="btn btn-primary btn-lg col-md-6" value="回復原本" />
            </form>
        </div>

@stop
