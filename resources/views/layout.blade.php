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
        body {
            text-decoration: none;
            background-color: #3a14c3;
            background-image: radial-gradient(circle at 20px 20px, #9347ce 10%, #3a14c3);
        }

        .main-wrapper {
            #display: grid;
            #height: 860px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-left: 0;
            margin-right: 0;
            #grid-template-rows: 160fr 20fr 655fr 25fr;
        }

        .banner-bg {
            width: 100%;
            /* width: 691px;
            height: 361px;
            position: absolute;
            left: 50%;
            margin-left: -345px; */
        }

        #content-list-wrapper {
            display: flex;
            justify-content: center;
        }

        .search-wrapper {
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }

        @media screen and  (max-width: 799px) {
            .company-li .documents-wrapper.font-size {
                font-size: 0.5rem;
            }

            .company-li .documents-wrapper img {
                width: 30px;
                height: 30px;
            }

            .company-li .documents-wrapper .company-intro .praise .heart {
                width: 15px;
                height: 15px;
                white-space: nowrap;
            }

            .company-li .documents-wrapper .company-intro .words {
                margin-top: 6%;
                padding-top: 6%;
                text-align: left;
                font-size: 0.1rem;
                white-space: nowrap;
                border-top: solid 1.5px #ffffff;
            }

            .company-li .documents-wrapper .company-intro .praise {
                text-align: right;
                font-size: 0.1rem;
            }

            .company-li .documents-wrapper .company-intro .praise .heart {
                width: 10px;
                height: 10px;
                margin-right: 5%;
            }

            input::-webkit-input-placeholder {
                /* placeholder颜色  */
                color: #aab2bd;
                /* placeholder字体大小  */
                font-size: 0.1rem;
                /* placeholder位置  */
                text-align: left;
            }

            .search-content .content-wrapper .input-style {
                height: 1rem;
            }

            .search-content .content-wrapper .search-button {
                padding-left: 5%;
            }

            .search-content .content-wrapper .search-company-part {
                padding-left: 15%;
            }

            .search-content .content-wrapper img {
                height: 1rem;
                width: auto;
            }

        }

        input:focus {
            border-style: solid;
            border-color: #03a9f4;
            box-shadow: 0 0 15px #03a9f4;
        }

        #footer-wrapper {
            justify-self: flex-end;
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>

<div class="main-wrapper">

    <div class="header-wrapper">
        @yield('header')
    </div>
    <div class="search-wrapper">
        @yield('search')
    </div>
    <div id="content-list-wrapper" v-show="companiesData">
        @yield('content')
    </div>
    <div id="footer-wrapper" v-show="totalCount > pageSize">
        @yield('footer')
    </div>

</div>

</body>

<script src="/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/js/vue.min.js"></script>
<script type="text/javascript" src="/plugins/layui/layui.all.js"></script>
<script>
    let pageIndex = 1;
    let pageSize = 16;
    let totalCount = "{{$dataCount}}";
    let keywords = null;
    let pageVue = new Vue({
        el: '#content-list-wrapper',
        data: {
            companiesData: [],
        },
        methods: {
            giveVote(companyId, index){
                giveVote(companyId, index);
            }
        }
    });

    let footerVue = new Vue({
        el: '#footer-wrapper',
        data: {
            totalCount: totalCount,
            pageSize: pageSize
        }
    });


    layui.use('laypage', function () {
        var laypage = layui.laypage;
        laypage.render({
            elem: 'footer'
            , count: totalCount
            , limit: pageSize
            , layout: ['prev', 'page', 'next']
            , jump: function (obj, first) {
                //点击非第一页页码时的处理逻辑。比如这里调用了ajax方法，异步获取分页数据
                if (!first) {
                    getCompaniesData(obj.curr, obj.limit, null);
                }
            }
        });
    });


    function getCompaniesData(pageIndex, pageSize, companyName) {
        let requestParams = {
            pageIndex: pageIndex,
            pageSize: pageSize,
            keywords: companyName
        };
        $.get('/companies-data', requestParams, function (result) {
            pageVue.companiesData = result.data.companiesData;
            footerVue.totalCount = result.data.count;
        }, 'json')
    }

    function searchCompany() {
        keywords = $("#company-name").val();
        getCompaniesData(pageIndex, pageSize, keywords);
    }
    ;

    function giveVote(companyId, index) {
        let requestParams = {
            companyId: companyId,
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        $.post('/give-vote', requestParams, function (result) {
            if (result.code) {
                pageVue.companiesData[index].vote_num += 1;
            }
            layer.msg(result.msg);
        }, 'json')
    }
    window.onload = function () {
        getCompaniesData(pageIndex, pageSize);
    }
</script>
</html>

