<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'board_id';

    protected $fllable=[
        'user_id'
        ,'content'
        ,'img'
        ,'like'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    // 항상 이름은 참조할 테이블의 복수형
    public function users(){    
        return $this->belongsTo(User::class, 'user_id');
    }
}
