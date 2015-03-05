@extends('admin.layout')

@section('contain')

    <div class="col-md-12">
    <div class="jumbotron">
                @if(Session::get('status')=="clear")
                    <div class="alert alert-success" role="alert">===清除日誌成功===</div>
                @endif
                    <center><a href="admin.log.clear">>>>清除系統日誌<<<</a></center>
                    <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered" id="sampleTable">
                <thead>
                    <tr>
                        <th class="type-int awesome">序號</th>
                        <th class="type-string">操作帳號</th>
                        <th class="type-string">身份別</th>
                        <th class="type-string">做事</th>
                        <th class="type-string">註解</th>
                        <th class="type-string">HTTP_CLIENT_IP</th>
                        <th class="type-string">HTTP_X_FORWARDED_FOR</th>
                        <th class="type-string">HTTP_X_FORWARDED</th>
                        <th class="type-string">HTTP_X_CLUSTER_CLIENT_IP</th>
                        <th class="type-string">HTTP_FORWARDED_FOR</th>
                        <th class="type-string">HTTP_FORWARDED</th>
                        <th class="type-string">REMOTE_ADDR</th>
                        <th class="type-string">HTTP_VIA</th>
                        <th class="type-string">時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{{$log->id}}}</td>
                        <td>{{{$log->account}}}</td>
                        <td>{{{$log->ldentity}}}</td>
                        <td>{{{$log->doing}}}</td>
                        <td>{{{$log->commit}}}</td>
                        <td>{{{$log->HTTP_CLIENT_IP}}}</td>
                        <td>{{{$log->HTTP_X_FORWARDED_FOR }}}</td>
                        <td>{{{$log->HTTP_X_FORWARDED}}}</td>
                        <td>{{{$log->HTTP_X_CLUSTER_CLIENT_IP}}}</td>
                        <td>{{{$log->HTTP_FORWARDED_FOR}}}</td>
                        <td>{{{$log->HTTP_FORWARDED}}}</td>
                        <td>{{{$log->REMOTE_ADDR}}}</td>
                        <td>{{{$log->HTTP_VIA}}}</td>
                        <td>{{{$log->timestamp}}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                    </div>
    </div>
</div>
@stop
