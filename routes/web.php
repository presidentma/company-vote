<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/company-vote','CompaniesVoteController@companiesList')->name('vote');
Route::match(['get', 'post'],'/company-publish','CompaniesVoteController@companiesPublish')->name('publish');
Route::post('/upload-image','CompaniesVoteController@uploadImage')->name('upload-image');
Route::post('/give-vote','CompaniesVoteController@giveVote')->name('/give-vote');
Route::get('/companies-data','CompaniesVoteController@companiesData')->name('companies-data');