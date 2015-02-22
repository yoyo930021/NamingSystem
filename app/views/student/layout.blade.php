<html>

<head>
    <title>雲端出缺席學生系統</title>
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
                    <a class="navbar-brand" href="">雲端出缺席學生系統</a>
                </div>
                @if(Session::get('studentlogin')==true)
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="#">人員管理</a>
                            </li>
                            <li><a href="#">課程管理</a>
                            </li>
                            <li><a href="#">簽到資料變更</a>
                            </li>
                            <li>
                                <a href="#">各樣申請</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a>{{{ Session::get('name') }}}</a>
                            </li>
                            <li><a href="student/logout">登出</a>
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
