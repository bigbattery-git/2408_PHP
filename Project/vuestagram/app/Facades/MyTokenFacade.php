<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyTokenFacade extends Facade{
	protected static function getFacadeAccessor()
	{	
		// AppServiceProvider.php에 등록한, config/app.php에 등록할 파사드 이름 넣으면 됨
		return 'MyToken';
	}
}