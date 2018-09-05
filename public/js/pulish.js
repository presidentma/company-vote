$(document).ready(function () {
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
                /^[\S]{0,15}$/
                ,'一句话最多15个字'
            ]
        });

        form.on('select(province)', function(data){
            let selectedIndex = data.elem.selectedIndex;
            provinceChange(selectedIndex);
            form.render("select");
        });

        form.on('submit(*)', function(data){
            $.post('/company-publish',data.field,function(result){
                if(result.code==1){
                    let screenWidth = window.screen.width;
                    if(screenWidth>400){
                        parent.location.reload();
                    } else {
                        parent.location.href=result.url;
                    }
                }  else {
                    layer.msg(result.msg);
                }
            });
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
    });
});

