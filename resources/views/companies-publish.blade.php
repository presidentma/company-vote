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
            padding-top: 10%;
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
<form class="layui-form" method="post">
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
                        <option value="3-20">3-20人</option>
                        <option value="21-50">21-50人</option>
                        <option value="51-100">51-100人</option>
                        <option value="101-200">101-200人</option>
                        <option value="200以上">200人以上</option>
                    </select>
                </div>
            </div>
            {{--公司类型--}}
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司类型</label>
                <div class="layui-input-block">
                    <select name="company_type" lay-filter="aihao">
                        <option value="IT/互联网">IT/互联网</option>
                        <option value="餐饮/娱乐">餐饮/娱</option>
                        <option value="商贸">商贸</option>
                        <option value="邮政快递服务">邮政快递服务</option>
                        <option value="建筑业">建筑业</option>
                    </select>
                </div>
            </div>
            {{--公司所在地--}}
            <div class="layui-form-item">
                <label class="layui-form-label"><span class="text-red">*</span>公司类型</label>
                <div class="layui-input-block">
                    <select name="address" lay-filter="aihao">
                        <option value="郑州市">郑州市</option>
                        <option value="开封市">开封市</option>
                        <option value="洛阳市">洛阳市</option>
                        <option value="平顶山市">平顶山市</option>
                        <option value="安阳市">安阳市</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">一句话介绍</label>
                <div class="layui-input-block">
                    <input type="text" name="introduce" lay-verify="introduce" autocomplete="off" placeholder="最多20字" class="layui-input">
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
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">确定发布</button>
                </div>
            </div>
        </div>

    </div>
</form>
<script>
    window.onload = function () {
        layui.use(['upload', 'form'], function () {
            var $ = layui.jquery
                    , upload = layui.upload, form = layui.form;
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#upload-button'
                , url: '/upload-image' ,
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content')
                } ,
                acceptMime: 'image/jpg, image/png',
                exts: 'jpg|png|gif'
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#company-logo').attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    //如果上传失败
                    console.log(res)
                    if (res.code > 0) {
                         $("#img-url").val(res.data.src);
                        return layer.msg('上传成功');
                    }
                    //上传成功
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var uploadText = $('#uploadText');
                    uploadText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                    uploadText.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });

            form.verify({

                //我们既支持上述函数式的方式，也支持下述数组的形式
                //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
                introduce: [
                    /^[\S]{0,20}$/
                    ,'一句话最多20个字'
                ]
            });

        });
    }


</script>

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/plugins/layui/layui.js"></script>
</body>
</html>