<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'boards';
    protected $primaryKey = 'b_id';

    // 마이그레이션
    // create, alter 등 스키마 코드 관리(테이블 생성, 컬럼명 변경 등)
    // 변경사항 관리 등을 위해 사용하는 옵션
    // make mygration이란 코멘트를 이용하여 만들 수 있지만, 대개 모델과 같이 만듦
    // mygrations의 폴더에서 관리하는 데, 옛날 자동으로 생성된 마이그레이션은 삭제할 것
    // 이후 작업은 mygrations에서 작업

    // seeders
    // 초기 세팅해야 하는 데이터를 작성하기 위한 옵션
    // 더미데이터, 초기 필요한 값을 넣기 위해 사용
    // 주로 몇개 안되는 초기 데이터를 넣기 위해 사용

    // factory
    // 더미데이터 만드는 공장 옵션
    // seeder로도 넣을 수 있는데 30만건 정도 넣으려면 좀 버거움
}