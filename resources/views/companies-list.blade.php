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
        margin-right: 0;
    }
{{-- 桌面端begin --}}
    .company-li {
        height: 90px;
    }

    .company-li .documents-wrapper {
        height:70px; 
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        background-color: #fff;
    }

    .company-li .documents-wrapper.font-size {
        font-family: "SimSun"
    }
    .company-li .documents-wrapper .company-logo {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .company-li .documents-wrapper .company-logo img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-sizing: border-box;
        border: solid 1px #00eab1;
        margin: 0 10px;
    }

    /* second */

    .company-li .documents-wrapper .company-intro {
        flex: 1;
        display: flex;
        flex-direction: column;

    }

    .company-li .documents-wrapper .company-intro .name {
        flex: 0 0 32px;
        position: relative;
    }
    .company-li .documents-wrapper .company-intro .title {
        position: absolute;
        height: 16px;
        font-size: 16px;
        font-weight: 500;
        bottom: 3px;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .company-li .documents-wrapper .company-intro .words {

    }
    .company-li .documents-wrapper .company-intro .words .content{
        padding-right: 10px;
        height: 30px;
        line-height: 15px;
        font-size: 12px;
        color: #b8b8b8;
        word-break: break-all;
        text-align: justify;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .company-li .documents-wrapper .vote {
        flex: 0 0 35px;
        background-color: #00eab1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
       }
    .company-li .documents-wrapper .vote .word{
       margin: auto;
    }
    .company-li .documents-wrapper .vote .word .content{
       height: 32px;
       line-height: 16px;
       width: 16px;
    }
    .company-li .documents-wrapper .vote .icon-num {
        color: #fff;
        font-size: 12px;
        text-align: center;
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
{{-- 桌面端end --}}

         /*移动端部分 */

         .mobile-content-wrapper {
            width: 345px;
            position: relative;
            margin: 0;
      
          }
      
          .mobile-content-wrapper .mobile-ul {
            clear: both;
            margin: 0 0;
            padding: 0 0;
          }
      
          .mobile-content-wrapper .li-item-wrapper {
            background-color: #fff;
            border-radius: 2px;
            height: 80px;
            margin: 12px 0;
            list-style: none;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-family: "SimSun"
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-vote-container {
            flex: 0 0 97px;
            position: relative;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-vote-container .company-vote {
            position: absolute;
            height: 30px;
            width: 70px;
            top: 16px;
            left: 16px;
            background-color: #00eab1;
            border-radius: 2px;
            display: flex;
            flex-direction: row;
            justify-content:center;
            align-items: center;
            color: #fff;
          }
          .mobile-content-wrapper .li-item-wrapper .company-vote-container .company-vote .icon{
            display: inline-block;
          }
          .mobile-content-wrapper .li-item-wrapper .company-vote-container .company-vote .vote-munber{
            display: inline-block;
            padding-left: 5px;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-logo {
            flex: 0 0 68px;
            display: flex;
            align-items: center;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-sizing: border-box;
            border: solid 1px #00eab1;
            margin: 0 10px;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-contents {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-contents .title-container {
            flex: 0 0 35px;
            justify-self: end;
            font-weight: 500;
            font-size: 1.1rem;
            position: relative;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-contents .title-container .title {
                   position: absolute;
height:1.1rem;
            bottom: 3px;
            overflow: hidden;
            text-overflow: ellipsis;
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-contents .sub-title-container {
            flex: 1;
            justify-self: start;
            font-size: 0.9rem;
            line-height: 1rem;
            color: #b8b8b8;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
          }
      
          .mobile-content-wrapper .li-item-wrapper .company-contents .sub-title-container .sub-title {
            flex: 0 0 2rem;
            word-break: break-all;
            text-align: justify;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
    <ul class="content-container layui-col-space20 layui-hide-xs">
        <li class="layui-col-xs6 layui-col-sm4 layui-col-md3 company-li" v-for="(companyItem,index) in companiesData">
            <div class="documents-wrapper font-size">
                <div class="company-logo">
                        <img :src="companyItem.img_url?companyItem.img_url:'/images/default-company-logo.png'" />
                </div>
                <div class="company-intro">
                    <div class="name"><span class="title" v-text="companyItem.name"></span></div>
                    <div class="words"><div class="content" v-text="companyItem.introduce"></div></div>
                </div>
                <div class="vote">
                    <div class="word"><div class="content" @click="giveVote(companyItem.id,index)">投票</div></div>
                    <div class="icon-num"><i class="fa fa-heart icon" @click="giveVote(companyItem.id,index)"></i><div v-text="companyItem.vote_num"></div></div>
                </div>
            </div>
        </li>
    </ul>
    <div class="mobile-content-wrapper layui-hide-sm layui-hide-md layui-hide-lg">
        <ul class="mobile-ul">
          <li class="li-item-wrapper" v-for="(companyItem,index) in companiesData">
            <div class="company-logo">
              <img :src="companyItem.img_url?companyItem.img_url:'/images/default-company-logo.png'" />
            </div>
            <div class="company-contents">
              <div class="title-container">
                <span class="title" v-text="companyItem.name"></span>
              </div>
              <div class="sub-title-container">
                <div class="sub-title" v-text="companyItem.introduce"></div>
              </div>
            </div>
            <div class="company-vote-container">
              <div class="company-vote">
                <i class="fa fa-heart-o icon" @click="giveVote(companyItem.id,index)"></i>
                <div class="vote-munber" v-text="companyItem.vote_num"></div>
              </div>
            </div>
          </li>
        </ul>
    </div>
@endsection

@section('footer')
<div id="footer"></div>
@endsection

<script>
    let screenWidth = window.screen.width;
    let totalCount = "{{$dataCount}}";
    function jumpPublish(){
        let publishUrl =   '/company-publish';
        if(screenWidth>400){
            layer.open({
                title:'企业信息发布',
                type:2,
                content:[publishUrl,'no'],
                offset: '50px',
                area: ['450px', '580px'],
                resize:false
            })
        }else {
            window.location.href=publishUrl;
        }
    }
</script>