<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->integer('user_from');
            $table->text('subject');
            $table->text('message');
            $table->enum('status', ['disabled', 'pending'])->default('pending');
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
        Schema::dropIfExists('staff_contact');
    }
}
