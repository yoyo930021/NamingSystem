@extends('admin.layout')

@section('contain')
<script>
    function check_all(obj,cName)
    {
    var checkboxs = document.getElementsByName(cName);
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
    }
</script>

    <div class="col-md-12">
    <div class="jumbotron">
                @if(Session::get('status')=="add")
                    <div class="alert alert-success" role="alert">===新增課程成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改課程成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除課程成功===</div>
                @endif
                    <div class="pull-right">
                        <form class="form-inline" method="post" action="admin.subject.add">
                            <div class="form-group">
                                <label class="sr-only">課程名</label>
                                <input type="text" class="form-control" name="subjectname" autofocus="" required=""  placeholder="課程名稱" />
                            </div>
                            <div class="form-group">
                                <label class="sr-only">老師</label>
                                <select class="form-control" placeholder="請選擇老師" name="teacher">
                                    @foreach($teachers as $teacher)
                                    <option value="{{{$teacher->id}}}">{{{$teacher->name}}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">課程</label>
                                <select class="form-control" placeholder="請選擇班級" name="class">
                                    @foreach($classall as $classone)
                                        <option value="{{{$classone->id}}}">{{{$classone->name}}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="btn btn-default" type="submit" value="新增課程" />
                        </form>
                    </div>
                    <form class="form-inline" action="admin.subject.delall" method="post">
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'subjects[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">課程名稱</th>
                        <th class="type-string">授課班級</th>
                        <th class="type-string">授課老師</th>
                        <th>是否啟用</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <th>
                            <input type="checkbox" name="subjects[]" value="{{{$subject->id}}}" />
                        </th>
                        <td>{{{$subject->id}}}</td>
                        <td>{{{$subject->name}}}</td>
                        <td>{{{ClassAll::find($subject->class_id)->name}}}</td>
                        <td>{{{Teacher::find($subject->teacher_id)->name}}}</td>
                        <td>{{{$subject->enabled==1?'啟用':'停用'}}}</td>
                        <td>
                            <a href="admin.subject.modify.{{{$subject->id}}}"><span class="glyphicon glyphicon-cog">修改</span></a>
                            <a href="admin.subject.del.{{{$subject->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
