<?php

namespace App\Providers;

use APP\UTILS\MyEncrypt;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	// 여기에 서비스 클래스 넣는거임
	public function register()
	{	// $this -> app -> bind('서비스클래스이름작명', function(){ return new MyEncrypt()});
		$this->app->bind('myEncrypt', function(){
			return new MyEncrypt();
		});
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}