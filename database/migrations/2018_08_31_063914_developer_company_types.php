<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 公司类型表
 * Class DeveloperCompanyTypes
 */
class DeveloperCompanyTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('developer_company_types',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',200)->default('互联网/IT')->comment("公司类型名称");
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
        //
        Schema::dropIfExists('developer_company_types');
    }
}
