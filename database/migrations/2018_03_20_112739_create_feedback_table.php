<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    // public function __construct() 
    // {
    //     $this->middleware('auth');
    // }
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('user_id')->unsigned()->nullable()->default(5);
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
