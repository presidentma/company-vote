<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 公司信息和投票数量
 * Class DeveloperCompaniesAndVote
 */
class DeveloperCompaniesAndVote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_companies_and_vote',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',200)->comment("公司名称");
            $table->string('img_url',200)->nullable()->comment("公司logo");
            $table->string('scale',50)->comment("公司规模");
            $table->string('company_type_id',200)->comment("公司类型");
            $table->string('address',50)->comment("公司所在地，市级");
            $table->string('introduce',255)->nullable()->comment("对自己公司的一句话介绍");
            $table->string('welfare_tags',255)->nullable()->comment("公司福利标签");
            $table->integer('vote_num')->default(0)->comment("被投票数量");
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            //$table->timestamp('updated_at')->default(\DB::raw('current_timestamp on update current_timestamp'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_companies_and_vote');
    }
}
