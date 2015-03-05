<html>

<head>
    <title>雲端出缺席管理系統</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--<link rel="stylesheet" href="css/bootstrap-theme.min.css" />-->
    <link rel=stylesheet href="css/index.css" />
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div id="body" class="container">
    <div id="contain">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">雲端出缺席管理系統</a>
                </div>
                @if(Auth::check())
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="admin.post">公告管理</a></li>
                        <li><a href="admin.class">班級管理</a></li>
                        <li><a href="admin.subject">課程管理</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">人員管理<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admin.student">學生管理</a></li>
                                <li><a href="admin.teacher">老師管理</a></li>
                                <li><a href="admin.admin">管理員管理</a></li>
                            </ul>
                        </li>
                        <li><a href="admin.rollcall">簽到資料變更</a></li>
                        <li><a href="admin.apply">各樣申請</a></li>
                        <li><a href="admin.setting">系統設定</a></li>
                        <li><a href="admin.log">系統日誌</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a>{{{Auth::user()->name}}}</a>
                        </li>
                        <li><a href="admin.logout">登出</a>
                        </li>
                    </ul>
                </div>
                @endif

            </div>

        </nav>

        @yield('contain')

    </div>
    <div id="footer">
        <div class="col-md-12" id="license">
            <p style="text-align:right">Auto-Distribute System All rights reserved Daan Computer Research Club</p>
        </div>
    </div>
</div>
</body>

</html>
