<html>
<head>

    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
    <meta name='apple-mobile-web-app-capable' content='yes'>
    <meta name='apple-mobile-web-app-status-bar-style' content='black'>
    <meta name='format-detection' content='telephone=no'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type='text/css'>img {
            width: 100%
        }</style>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/plugins/layui/css/layui.css">

    <style>
        .main-wrapper {
            width: 90%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .main-wrapper .image-upload-wrapper {
            align-self: center;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            height: 100px;
            margin-left: 10%;
            align-items: center;
        }

        .main-wrapper .image-upload-wrapper .upload-image img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
        }

        .main-wrapper .image-upload-wrapper .upload-center {
            flex: 1;
            padding: 0 5%;
            word-break: break-all;
        }

        .main-wrapper .image-upload-wrapper .upload-right {
        }

        .input-group-wrapper {
            margin-top: 10px;
        }

        .text-red {
            color: red;
        }
    </style>
</head>

<body>
<form class="layui-form" method="post" name="publishForm">
    <div class="main-wrapper">

        <div class="image-upload-wrapper">
            <div class="layui-upload-list upload-image">
                <img class="layui-upload-img" src="/images/default-company-logo.png" id="company-logo">
            </div>
            <div class="upload-center"><span class="text-red">(上传图片格式支持.jpg,.png,宽高比例为1:1)</span>
                <p id="uploadText"></p>
            </div>
            <div class="upload-right">
                <button type="button" class="layui-btn layui-btn-normal layui-btn-radius layui-btn-sm"
                        id="upload-button">上传图片
                </button>
            </div>
            <input type="hidden" name="img_url"  id="img-url">
        </div>
        {{csrf_field()}}
        <div class="input-group-wrapper">
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" required lay-verify="required" autocomplete="off" placeholder="请输入公司名称" class="layui-input">
                </div>
            </div>
            {{--公司规模--}}
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司规模</label>
                <div class="layui-input-block">
                    <select name="scale" lay-filter="aihao">
                        <option value="3-20">0-50人</option>
                        <option value="21-50">0-51人</option>
                        <option value="51-100">51-100人</option>
                        <option value="101-200">151-500人</option>
                        <option value="200以上">500人以上</option>
                    </select>
                </div>
            </div>
            {{--公司类型--}}
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司类型</label>
                <div class="layui-input-block">
                    <select name="company_type" lay-filter="aihao">
                        <option value="未融资">未融资</option>
                        <option value="天使轮">天使轮</option>
                        <option value="A轮">A轮</option>
                        <option value="B轮">B轮</option>
                        <option value="C轮">C轮</option>
                        <option value="C轮以上">C轮以上</option>
                    </select>
                </div>
            </div>
            {{--公司所在地--}}
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司地址</label>
                <div class="layui-input-inline">
                    <select name="province" id="province-select" lay-verify="required" lay-filter="province">
                        <option value="">请选择省</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="city" id="city-select" lay-verify="required" lay-filter="city">
                        <option value="">请选择城市</option>
                    </select>
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">一句话介绍</label>
                <div class="layui-input-block">
                    <input type="text" name="introduce" lay-verify="introduce" autocomplete="off" placeholder="最多15字" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">福利标签</label>
                <div class="layui-input-block">
                    <input type="text" name="welfare_tags" autocomplete="off" placeholder="五险一金,周末双休,带薪休假" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="*" >确定发布</button>
                </div>
            </div>
        </div>

    </div>
</form>

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/js/pulish.js"></script>
<script type="text/javascript" src="/js/city.js"></script>
</body>
</html>