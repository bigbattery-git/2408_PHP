<?php

namespace Database\Factories;

use App\Models\BoardsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{

    public function definition()
    {
        $arrImg=[
            'img/sample1.jpg'
            ,'img/sample2.png'
            ,'img/sample3.jpg'
            ,'img/sample4.png'
            ,'img/sample5.jpg'
        ];
        $userInfo = User::inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween($userInfo->created_at, 'now');
        // $date = $this->faker->dateTimeBetween('-5 years');
        return [
            'u_id' => $userInfo->u_id
            ,'bc_type' => BoardsCategory::inRandomOrder()->first()->bc_type
            ,'b_title' => $this->faker->realText(50)
            ,'b_content' => $this->faker->realText(200)
            ,'b_img' => Arr::random($arrImg)
            ,'created_at' => $date
            ,'updated_at' => $date
        ];
    }
}