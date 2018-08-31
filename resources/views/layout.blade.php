<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>App Name - @yield('title')</title>
    <link rel="stylesheet" href="/plugins/layui/css/layui.css">



    <style>
        body{
            text-decoration: none;
            background-color: #3a14c3;
            background-image: radial-gradient(circle at 20px 20px , #9347ce 10% ,#3a14c3);
        }
        .main-wrapper{
            display: grid;
            height: 860px;
            margin-left: 0;
            margin-right: 0;
            grid-template-rows: 160fr 20fr 655fr 25fr;
        }
        .banner-bg {
            width: 100%;
            /* width: 691px;
            height: 361px;
            position: absolute;
            left: 50%;
            margin-left: -345px; */
        }
    </style>
</head>
<body>

<div class="main-wrapper">

    <div class="header-wrapper">
       @yield('header')
    </div>
    <div class="search-wrapper">
        this search @yield('search')
    </div>
    <div class="content-wrapper">
        this content
        <div class="container">
            @yield('content')
        </div>
    </div>
    <div class="footer-wrapper">
        this footer @yield('footer')
    </div>

</div>

</body>

<script language="text/javascript" src="/plugins/layui/layui.js"></script>

</html>

