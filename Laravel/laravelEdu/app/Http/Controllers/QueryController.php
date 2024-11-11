<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QueryController extends Controller
{
    public function index(Request $request){
        

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
        // $result = DB::table('users')->get();

        $result = DB::table('users')->where('u_name', '=', '관리자')->get();

        $result = DB::table('boards')
                    ->where('bc_type','=','0')
                    ->where('b_id', '<', 5)
                    ->get();

        $result = DB::table('boards')
                    ->where('bc_type', '=', '0')
                    ->orWhere('b_id', '<', 10)
                    ->get();

        $result = DB::table('boards')
                    ->select('b_title', 'b_content')
                    ->whereIn('b_id', [1, 2])
                    ->get();

        $result = DB::table('boards')
                    ->whereNull('deleted_at')
                    ->get();

        $result = DB::table('users')
                    ->whereBetween('created_at',['2024-01-01 00:00:00', '2024-12-31 23:59:59'])
                    ->get();

        $result = DB::table('boards')
                    ->select('bc_type', DB::raw('COUNT(*) cnt'))
                    ->groupBy('bc_type')
                    ->having('cnt', '>' ,'3')
                    ->get();

        $result = DB::table('boards')
                    ->select('b_id', 'b_title')
                    ->orderBy('b_id')
                    ->limit(1)
                    ->offset(2)
                    ->get();
        $requestData = [
            'u_id' => 1
        ];

        $result = DB::table('users')
                    ->when($requestData['u_id'], function($query, $u_id){
                        $query->where('u_id', '=', $u_id);
                    })
                    ->get();

        $result = DB::table('boards')
                    ->whereNull('deleted_at')
                    ->where(function($query){
                        $query->where('b_title', 'like', '%자유%')
                            ->orWhere('b_title', 'like', '%질문%');
                    })
                    ->get();

        $result = DB::table('boards')
                    ->count();

        // $result = DB::table('users')
        //             ->insert([
        //                 'u_email' => 'kim@admin.com'
        //                 ,'u_password' => Hash::make('qwer1234')
        //                 ,'u_name' => '김한강'
        //             ]);

        // $result = DB::table('users')
        //             ->where('u_name', '=', '김한강')
        //             ->update([
        //                 'u_name' => '김시라소니'
        //             ]);

        // $result = DB::table('users')
        //             ->where('u_name', '=', '김시라소니')
        //             ->delete()
        //             ;


        // select
        // 자동으로 클래스의 복수명을 테이블명으로 인식해서 가져옴
        // original, attributes 두 개의 값을 가져옴
        // original :  원본
        // attributes : 수정된 데이터
        $result = User::get();

        // where 등
        $result = User::select('u_name')
                    ->where('u_id', '=', '1')
                    ->get();
        
        // insert
        // 새운운 데이터를 만드는 격
        // $userInsert->컬럼명 = 값 할당
        // $userInsert = new User();
        // $userInsert->u_email = $request->u_email;
        // $userInsert->u_password = $request->u_password;
        // $userInsert->u_name = $request->u_name;
        // $userInsert->save();
    
        // Update
        // $userUpdate = User::find(4);
        // $userUpdate->u_name = '김철수';
        // $userUpdate->save();

        // Delete
        // 하드딜리트 X, 소프트딜리트 O
        // $userDelete = User::destroy(4);

        // 삭제된 데이터 포함하여 검색 
        $result = User::withTrashed()->find(4);

        // 삭제된 데이터만 검색 
        $result = User::onlyTrashed()->get();

        // 삭제된 데이터를 되살리기
        $result = User::where('u_id', '=', 4)->restore();

        var_dump(Hash::make('qwer1234'));

        return '';
    }
}
