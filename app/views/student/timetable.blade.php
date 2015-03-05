@extends('student.layout')

@section('contain')

        <div class="col-md-12">
            <div class="page-header">
                <h1>課表：</h1>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>時間</th>
                        <th>星期一</th>
                        <th>星期二</th>
                        <th>星期三</th>
                        <th>星期四</th>
                        <th>星期五</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>第1節</td>
                        @foreach($week1 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第2節</td>
                        @foreach($week2 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第3節</td>
                        @foreach($week3 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第4節</td>
                        @foreach($week4 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第5節</td>
                        @foreach($week5 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第6節</td>
                        @foreach($week6 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>第7節</td>
                        @foreach($week7 as $week)
                            <td>{{{$week->subject['name']}}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

@stop
