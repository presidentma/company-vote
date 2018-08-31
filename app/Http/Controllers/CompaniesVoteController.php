<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompaniesVoteController extends Controller
{
    public function companiesList()
    {
        return view('companies-list',['name'=>'中国人民银行']);
    }
}
