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
                <div class="navbar-right">
                    <a href="admin/logout" class="btn btn-default navbar-btn">登出</a>
                    <br>
                </div>
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
