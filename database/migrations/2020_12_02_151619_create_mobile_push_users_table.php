<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilePushUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_push_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user');
            $table->text('platforma');
            $table->text('browser');
            $table->text('mac');
            $table->text('authorized');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_push_users');
    }
}
