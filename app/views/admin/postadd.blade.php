@extends('admin.layout')

@section('contain')

    <script src="ckeditor/ckeditor.js"></script>
        <div class="col-md-12">
            <form method="post" action="
            @if(isset($id))
                admin.post.modify
            @endif
            ">
                <div class="page-header">
                    <h1>新增公告</h1>
                </div>
                <div class="form-group">
                <label>標題</label>
                    <input type="text" class="form-control" name="title" autofocus="" required="" value="{{{ $title or '' }}}"/>
                </div>
                <div class="form-group">
                    <label>內容</label>
                    <textarea class="ckeditor" cols="40" id="editor1" name="content" rows="10" autofocus="" required="">{{{ $content or '' }}}</textarea>
                </div>
                <input type="hidden" value="{{{$id or ''}}}" name="id">
                <input type="submit" value="送出" class="form-control btn-success" />
            </form>
        </div>

@stop
