@extends('layout')

@section('title', $name)


@section('header')
    <img class="banner-bg layui-hide-xs" src="/images/vote-header.png" />
    <img class="banner-bg layui-hide-sm layui-hide-md layui-hide-lg" src="/images/vote-header-mobile.png" />
@endsection

<style>
    .content-container {
        width: 90%;
        margin-left: 0;
        margin-right: 0;;
    }

    .company-li {
        position: relative;
    }

    .company-li .documents-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .company-li .documents-wrapper.font-size {

    }

    .company-li .documents-wrapper img {
        position: relative;
        flex: 1 auto auto;
        align-self: center;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 50%;
        margin-left: 10px;
    }

    /* second */

    .company-li .documents-wrapper .company-intro {
        position: relative;
        padding-top: 3%;
        flex: 2.6;
        width: 100%;
        text-align: center;
        color: #ffffff;
        display: flex;
        padding-left: 7px;
        flex-direction: column;
    }

    .company-li .documents-wrapper .company-intro .name {
        text-align: left;
    }

    .company-li .documents-wrapper .company-intro .words {
        margin-top: 6%;
        padding-top: 6%;
        text-align: left;
        font-size: 0.7rem;
        border-top: solid 1.5px #ffffff;
    }

    .company-li .documents-wrapper .company-intro .praise {
        text-align: right;
        font-size: 0.7rem;
        color: #ff69fa;
    }
    .company-li .documents-wrapper .company-intro .praise .heart {
        width: 20px;
        height: 20px;
    }

    .company-li .documents-wrapper .vote {
        position: relative;
        flex: 1;
        width: 100%;
        padding: 6%;
        text-align: right;
        word-break: break-all;
        font-weight: 500;
    }
    .search-content{
        width: 90%;
    }
    .search-content .content-wrapper{
        margin: 0 15%;
        display: grid;
        grid-template-columns: 3fr 1fr 2fr;
    }
    .search-content .content-wrapper .input-style{
        border: solid 0.5px #fff;
        border-radius: 10px;
        display: block;
        padding-left: 10px;
        width: 100%;
        height: 30px;
        color: #ffffff;
        background-color: transparent;
    }
    .search-content .content-wrapper .search-button{
        padding-left: 5%;
    }
    .search-content .content-wrapper .search-company-part{
        padding-left: 15%;
    }
    .search-content .content-wrapper img{
        height: 30px;
        width: auto;
    }
    input::-webkit-input-placeholder {
       /* placeholder颜色  */
                color: #aab2bd;
        /* placeholder字体大小  */
              font-size: 0.8rem;
       /* placeholder位置  */
                text-align: left;
         }
</style>
@section('search')

    <div class="search-content">
        <form>
        <div class="content-wrapper">
                <div>
                    <input type="text" class="input-style" id="company-name" name="company-name" placeholder="请输入你要搜索的公司名称">
                </div>
                <div class="search-button">
                    <img src="/images/search-button.png" onclick="searchCompany()">
                </div>
            <div class="search-company-part">
                <img src="/images/participation.png" onclick="jumpPublish()">
            </div>


        </div>
        </form>
    </div>

@endsection

@section('content')
    <ul class="content-container layui-col-space20">
        <li class="layui-col-xs6 layui-col-sm4 layui-col-md3 company-li" v-for="(companyItem,index) in companiesData">
            <img width="100%" src="/images/companies-background.png">
            <div class="documents-wrapper font-size">
                <img :src="companyItem.img_url?companyItem.img_url:'/images/default-company-logo.png'">
                <div class="company-intro">
                    <div class="name" v-text="companyItem.name"></div>
                    <div class="words" v-text="companyItem.introduce"></div>
                    <div class="praise"><img class="heart" src="/images/heart.png"><span v-text="companyItem.vote_num"></span></div>
                </div>
                <div class="vote"><span @click="giveVote(companyItem.id,index)">投票</span></div>
            </div>
        </li>

    </ul>
@endsection

@section('footer')
<div id="footer"></div>
@endsection

<script>
    let totalCount = "{{$dataCount}}";
    function jumpPublish(){
        let publishUrl =   '/company-publish';
        let screenWidth = window.screen.width;
        if(screenWidth>400){
            layer.open({
                title:'企业信息发布',
                type:2,
                content:[publishUrl,'no'],
                offset: '50px',
                area: ['450px', '580px'],
                resize:false
                //fixed: false
            })
        }else {
            window.location.href=publishUrl;
        }
    }
</script>