<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Trait : 수레, 특성. 여러 필요한 함수를 저장해서 클래스 안에서 use하여 사용하는 것
    // SoftDelete 트레이드 : 해당 모델에 softe delete 적용하고 싶을 때 추가 
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; 

    // pk 지정하기 protected $primaryKey = 'pk이름';
    // 일반적으로 pk 지정 안해주면 'id'로 지정함
    protected $primaryKey = 'u_id';

    // 테이블명 따로 세팅하기
    // 본래 테이블명은 모델 클래스명을 복수형으로 바꿔서 자동 설정됨
    // 그게 아니라면 따로 세팅해야 함
    protected $table = 'users';

    // 이런것들
    // protected $table = 'boards_categroy';

    // update, insert 시 엄격하게 데이터 삽입, 수정하게 하는 방법
    // 변경 가능한 컬럼명을 지정하는 방법

    // 방법1 화이트리스트 방식
    // 허용할 컬럼리스트 작성 $fillable 고정
    protected $fillable = [
        'u_email'
        ,'u_password'
        ,'u_name'
        ,'created_at'
        ,'updated_at'
        ,'deleted_at'
    ]; // 이 컬럼의 변경은 허용하겠다는 뜻

    // 방법2 블랙리스트 방식
    // 허용하지 않을 컬럼리스트 작성 $guarded 고정
    protected $guarded = [
        'u_id'
    ];
}
