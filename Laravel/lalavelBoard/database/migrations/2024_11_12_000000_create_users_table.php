<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('u_id');
            $table->string('u_email', 100)->unique();
            $table->string('u_password', 255);
            $table->string('u_name', 50);
            $table->timestamps();                       // 생성일자, 수정일자
            $table->softDeletes();                      // 삭제일자
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
