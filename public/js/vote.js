let pageIndex = 1;
let pageSize = 16;
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
    let layout = screenWidth>400?['prev', 'page', 'next']:['prev', 'next'];
    pageSize = screenWidth>400?pageSize:10;
    laypage.render({
        elem: 'footer'
        , count: totalCount
        , limit: pageSize
        , layout: layout
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
        layer.msg(result.msg,{
           offset: '20px',
zIndex:layer.zIndex

        });
    }, 'json')
}
window.onload = function () {
    getCompaniesData(pageIndex, pageSize);
}