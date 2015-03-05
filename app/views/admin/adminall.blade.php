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
                    <div class="alert alert-success" role="alert">===新增管理員成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改管理員成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除管理員成功===</div>
                @endif
                    <form class="form-inline" action="admin.admin.delall" method="post">
                        <a class="btn btn-default" href="admin.admin.add">新增
                        </a>
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'admins[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">管理員名稱</th>
                        <th class="type-string">帳號</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <th>
                            <input type="checkbox" name="admins[]" value="{{{$admin->id}}}" />
                        </th>
                        <td>{{{$admin->id}}}</td>
                        <td>{{{$admin->name}}}</td>
                        <td>{{{$admin->account}}}</td>
                        <td>
                            <a href="admin.admin.modify.{{{$admin->id}}}"><span class="glyphicon glyphicon-cog">修改</span></a>
                            <a href="admin.admin.del.{{{$admin->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
