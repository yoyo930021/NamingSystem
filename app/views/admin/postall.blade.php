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
        <form class="form-inline" action="admin.post.delall" method="post">
                @if(Session::get('status')=="add")
                    <div class="alert alert-success" role="alert">===新增公告成功===</div>
                @endif
                @if(Session::get('status')=="modify")
                    <div class="alert alert-success" role="alert">===修改公告成功===</div>
                @endif
                @if(Session::get('status')=="move")
                    <div class="alert alert-success" role="alert">===移動公告成功===</div>
                @endif
                @if(Session::get('status')=="delect")
                    <div class="alert alert-success" role="alert">===刪除公告成功===</div>
                @endif
            <a class="btn btn-default" href="admin.post.add">新增公告
            </a>
            <input class="btn btn-default" type="submit" value="刪除"  />

            <table class="table table-hover" id="sampleTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="all" onclick="check_all(this,'post[]')"/>
                        </th>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">公告名稱</th>
                        <th class="type-string">發佈人</th>
                        <th>時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th>
                            <input type="checkbox" name="post[]" value="{{{$post->id}}}" />
                        </th>
                        <td>{{{$post->id}}}</td>
                        <td>{{{$post->title}}}</td>
                        <td>{{{$post->author}}}</td>
                        <td>{{{$post->timeStamp}}}</td>
                        <td>
                            <a href="admin.post.modify.{{{$post->id}}}"><span class="glyphicon glyphicon-cog">修改</span></a>
                            <a href="admin.post.top.{{{$post->id}}}"><span class="glyphicon glyphicon-circle-arrow-up">上移</span></a>
                            <a href="admin.post.down.{{{$post->id}}}"><span class="glyphicon glyphicon-circle-arrow-down">下移</span></a>
                            <a href="admin.post.del.{{{$post->id}}}"><span class="glyphicon glyphicon-remove">刪除</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@stop
