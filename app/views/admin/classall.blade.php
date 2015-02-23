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
                    <div class="alert alert-success" role="alert">===新增班級成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改班級成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除班級成功===</div>
                @endif
                    <div class="pull-right">
                        <form class="form-inline" method="post" action="admin.class.add">
                            <div class="form-group">
                                <label class="sr-only">班級名</label>
                                <input type="text" class="form-control" name="classname" autofocus="" required=""  placeholder="班級名稱" />
                            </div>
                            <div class="form-group">
                                <label class="sr-only">老師</label>
                                <select class="form-control" placeholder="請選擇老師" name="teacher">
                                    @foreach($teachers as $teacher)
                                    <option value="{{{$teacher->id}}}">{{{$teacher->name}}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="btn btn-default" type="submit" value="新增班級" />
                        </form>
                    </div>
                    <form class="form-inline" action="admin.class.delall" method="post">
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'classone[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">班級名稱</th>
                        <th class="type-string">班導</th>
                        <th>學生數</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classall as $classone)
                    <tr>
                        <th>
                            <input type="checkbox" name="classone[]" value="{{{$classone->id}}}" />
                        </th>
                        <td>{{{$classone->id}}}</td>
                        <td>{{{$classone->name}}}</td>
                        <td>{{{$classone->teacher['name']}}}</td>
                        <td>{{{count($classone->student)}}}</td>
                        <td>
                            <a href="admin.class.modify.{{{$classone->id}}}"><span class="glyphicon glyphicon-cog">修改(成員)</span></a>
                            <a href="admin.class.del.{{{$classone->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
