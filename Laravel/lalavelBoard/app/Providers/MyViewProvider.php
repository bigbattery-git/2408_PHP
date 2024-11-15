<?php

namespace App\Providers;

use App\Models\BoardsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MyViewProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('사용할blade tamplate 이름', function($view){ 해야 할 처리 })
        // View::composet(['blade이름1', 'blade이름2',...], function($view){해야 할 처리})
        // $view : view를 랜더링 한 객체를 담고 있음 -> include, extends 등을 모두 처리한 blade.php의 정보를 담고 있음
        // 왜씀? 복수의 view에서 로직을 처리하기 위해
        View::composer('*', function($view){
            $resultBoardCategoryInfo = BoardsCategory::orderBy('bc_type')->get();
            $view->with('myGlobalBoardsCategoryInfo', $resultBoardCategoryInfo);
        });
    }
}
