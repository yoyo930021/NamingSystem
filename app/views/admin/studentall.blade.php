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
                    <div class="alert alert-success" role="alert">===新增學生成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改學生成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除學生成功===</div>
                @endif
                    <form class="form-inline" action="admin.student.delall" method="post">
                        <a class="btn btn-default" href="admin.student.add">新增
                        </a>
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'students[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">學生名稱</th>
                        <th class="type-string">班級</th>
                        <th class="type-string">座號</th>
                        <th class="type-string">班導</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <th>
                            <input type="checkbox" name="students[]" value="{{{$student->id}}}" />
                        </th>
                        <td>{{{$student->id}}}</td>
                        <td>{{{$student->name}}}</td>
                        <td>{{{ClassAll::find($student->class_id)->name}}}</td>
                        <td>{{{$student->seat}}}</td>
                        <td>{{{Teacher::find(ClassAll::find($student->class_id)->teacher_id)->name}}}</td>
                        <td>
                            <a href="admin.student.modify.{{{$student->id}}}"><span class="glyphicon glyphicon-cog">修改</span></a>
                            <a href="admin.student.del.{{{$student->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
