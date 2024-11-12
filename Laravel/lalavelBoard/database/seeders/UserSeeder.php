<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function save($email, $pw, $name){
        $user = new User();
        $user->u_email = $email;
        $user->u_password = Hash::make($pw);
        $user->u_name = $name;
        $user->save();
    }
    public function run()
    {
        // $this->save('admin@admin.com', 'qwer1234', '관리자');
        // $this->save('alpha@admin.com', 'asdf1234', '알파임');
        // $this->save('bravo@admin.com', 'zxcv1234', '브라보임');

        User::factory(30)->create();
    }
}
