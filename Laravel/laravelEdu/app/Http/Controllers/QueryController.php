<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function index(){
        

        // $result = DB::select('select * from users');
        // $result = DB::select('select * from users where u_email = :u_email', ['u_email' => 'admin@admin.com']);

        // // DB::insert('insert into boards_category (bc_type, bc_name) values(?, ?)', ['3', '깔깔유머집']);
        // // DB::update('update boards_category set bc_name=? where bc_type=?', ['미어캣게시판', '3']);
        // DB::delete('delete from boards_category where bc_type = ?',['3']);

        // var_dump($result);

        // 쿼리빌더 체이닝
        // users 테이블 모든 정보 조회
        // before -> select * from users;

        // after
        $result = DB::table('users')->get();
        var_dump($result);

        return '';
    }
}
