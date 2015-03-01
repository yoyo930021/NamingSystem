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
                    <div class="alert alert-success" role="alert">===新增老師成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改老師成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除老師成功===</div>
                @endif
                    <form class="form-inline" action="admin.teacher.delall" method="post">
                        <a class="btn btn-default" href="admin.teacher.add">新增
                        </a>
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'teachers[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">老師名稱</th>
                        <th class="type-string">班導班</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <th>
                            <input type="checkbox" name="teachers[]" value="{{{$teacher->id}}}" />
                        </th>
                        <td>{{{$teacher->id}}}</td>
                        <td>{{{$teacher->name}}}</td>
                        <td>{{{$teacher->class_id!=0?ClassAll::find($teacher->class_id)->name:"無"}}}</td>
                        <td>
                            <a href="admin.teacher.modify.{{{$teacher->id}}}"><span class="glyphicon glyphicon-cog">修改</span></a>
                            <a href="admin.teacher.del.{{{$teacher->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
