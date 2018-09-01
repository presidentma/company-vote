<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompaniesVote;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class CompaniesVoteController extends Controller
{
    public function companiesList()
    {
        $dataCount = CompaniesVote::count();
        return view('companies-list', ['name' => '十佳公司投票', 'dataCount' => $dataCount]);
    }

    public function companiesPublish(Request $request)
    {
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $companiesVoteModel = new CompaniesVote();
            $companiesVoteModel->name = $postData['name'];
            $companiesVoteModel->img_url = $postData['img_url'];
            $companiesVoteModel->scale = $postData['scale'];
            $companiesVoteModel->address = $postData['address'];
            $companiesVoteModel->company_type_id = $postData['company_type'];
            $companiesVoteModel->introduce = $postData['introduce'];
            $companiesVoteModel->welfare_tags = $postData['welfare_tags'];
            if ($companiesVoteModel->save()) {
                return redirect()->route('vote');
            }
        }
        return view('companies-publish', ['title' => '发布公司']);
    }

    public function uploadImage(Request $request)
    {
        $status = 0;
        $fileUrl = '';
        $date = date('Ymd');
        $file = $request->file('file');
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();   // 扩展名
            $realPath = $file->getRealPath();  //临时文件的绝对路径
            $type = $file->getClientMimeType();   // image/jpeg

            // 上传文件
            $filename = md5((time() + random_int(0, 1000)));
            // 使用我们新建的uploads本地存储空间（目录）
            $path = $file->store($filename, 'upload-logo');
            if ($path) {
                $fileUrl = '/storage/uploads/images/logos/' . $date . '/' . $path;
                $status = 1;
                $message = '上传成功';
            } else {
                $message = "上传失败";
            }
        } else {
            $message = '文件未通过验证,上传失败';
        }

        return ['code' => $status, 'msg' => $message, 'data' => ['src' => $fileUrl]];
    }

    public function companiesData(Request $request)
    {
        $returnData = ['code' => 0, 'msg' => '没有数据', 'data' => []];
        $pageIndex = $request->get('pageIndex');
        $pageSize = $request->get('pageSize');
        $keywords = $request->get('keywords',null);
        if (!$pageIndex || !$pageSize) {
            return $returnData;
        }
        $query = CompaniesVote::select();
        isset($keywords) && !empty($keywords) && $query->where('name','like','%'.$keywords.'%');
        $dataCount = $query->count();
        $selectQuery =   CompaniesVote::skip(($pageIndex - 1) * $pageSize)->take($pageSize);
        isset($keywords) && !empty($keywords) && $selectQuery->where('name','like','%'.$keywords.'%');
        $companiesData = $selectQuery->orderBy('vote_num','DESC')->orderBy('id','ASC')->get()->toArray();
        return ['code' => 1, 'msg' => '获取成功', 'data' => ['companiesData' => $companiesData,'count'=>$dataCount]];
    }

    public function giveVote(Request $request)
    {
        $maxVoteTime = 3;//每人最大可投票次数
        $companyId = $request->request->get('companyId');
        $clientIp = $request->getClientIp();
        $clientVoteTime = Cache::get($clientIp,0);
        if($clientVoteTime>=3){
           return ['code'=>0,'msg'=>'对不起，您的次数已用完'];
        }
        $result = CompaniesVote::where('id',$companyId)->increment('vote_num');
        if($result){
            Cache::forever($clientIp,($clientVoteTime+1));
            return ['code'=>1,'msg'=>'投票成功'];
        }
    }


}
