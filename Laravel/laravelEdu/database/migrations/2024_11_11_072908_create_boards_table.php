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
        // 스키마 검색해보셈
        // DB의 전체 또는 일부의 구조를 말함
        // 라라벨은 table 명을 알아서 클래스의 복수형으로 지음
        // 그게 아니라면 데이블 이름 다시 적어면면 됨
        // table 생성 전용
        Schema::create('boards_test', function (Blueprint $table) {
            // 컬럼들을 정의해주는 영역
            // 예네들은 기본으로 생성됨 ========
            $table->id('b_id')->unsigned();     			// id의 파라미터에 이 테이블의 pk를 적어줄 것. 만약 파라미터에 unsigned 적기 싫으면 체이닝메소드 쓰셈. 이거 내가 적은거임
            $table->timestamps(); 							// created_at, updated_at을 자동으로 생성해줌 단, null값 허용됨. 하지만 모델에서 null 허용 안되게 계속 관리해줌
			// $table->timestamp('created_at')->default(DB:raw('current_timestamp')); 만약 위 timestemps()를 안 쓸경우
            // =============================
            $table->bigInteger('u_id', false, true); 		// 다른 컬럼명 입력
            $table->char('bc_type', 1);
            $table->string('b_title', 50);          		// varchar = string
            $table->string('b_content', 200);
            $table->string('b_img', 100);
			$table->timestamp('deleted_at')->nullable();	// null값 허용하는 deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 테이블 드랍 전용
        // 항상 up과 반대되는 처리를 만들어야 함
        Schema::dropIfExists('boards_test');
    }
};
