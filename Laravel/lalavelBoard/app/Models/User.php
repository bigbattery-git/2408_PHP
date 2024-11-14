<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'u_id';

    /**
     * 화이트리스트
     */
    protected $fillable = [
        'u_name'
        ,'u_email'
        ,'u_password'
    ];

    /**
     * 직렬화 하여 데이터를 전달할 때 보내면 안되는 컬럼명을 설정하는 곳
     */
    protected $hidden = [
        'u_password'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
