<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMumbaiDabbavalaTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        /*
        |--------------------------------------------------------------------------
        | Customer Details
        |--------------------------------------------------------------------------
        */
        Schema::connection('mysql')->create('customer_master', function (Blueprint $table) {
            $table->increments('id',true)
                    ->unsigned();
            $table->string('l_name',20);
            $table->string('f_name',20);
            $table->string('m_name',20);
            $table->string('email')
                    ->unique();
            $table->string('password',100);
            $table->integer('age')
                    ->unsigned();
            $table->string('occupation',99);
            $table->string('marital_status',10);
            $table->string('gender',10);
            $table->string('address',199);
            $table->string('pincode',6);
            $table->string('phone_number',10)
                            ->unique();
            $table->boolean('Present_member');
            $table->engine = 'InnoDB';
        });
        /*
        |--------------------------------------------------------------------------
        | Tiffinvala Details
        |--------------------------------------------------------------------------
        */
        Schema::connection('mysql')->create('tiffinvala_master', function (Blueprint $table) {
            $table->increments('id',true)
                    ->unsigned();
            $table->string('l_name',20);
            $table->string('f_name',20);
            $table->string('m_name',20);
            $table->integer('age')->unsigned();
            $table->string('gender',10);
            $table->string('password',100);
            $table->string('marital_status',10);
            $table->string('phone_number',10)
                        ->unique();
            $table->string('address',199);
            $table->float('salary_def',10,2)
                    ->unsigned()->default(1500);
            $table->integer('number_of_orders')->default(0);
            $table->engine = 'InnoDB';
        });

        /*
        |--------------------------------------------------------------------------
        | Service Details
        |--------------------------------------------------------------------------
        */

        Schema::connection('mysql')->create('services', function (Blueprint $table) {
            $table->increments('service_id',true)
                    ->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('tiffinvala_id')->unsigned();
            $table->boolean('working');
            $table->integer('service_val')->default(150);
            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql')->table('services', function (Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('customer_master');
            $table->foreign('tiffinvala_id')->references('id')->on('tiffinvala_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::connection('mysql')->dropIfExists('services');
        Schema::connection('mysql')->dropIfExists('customer_master');
        Schema::connection('mysql')->dropIfExists('tiffinvala_master');
    }
}
