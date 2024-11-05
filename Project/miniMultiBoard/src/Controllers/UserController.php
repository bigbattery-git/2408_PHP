<?php


namespace Controllers;

use Controllers\Controller; // index에 autoload 덕분에 require_once 안적어도 됨

class UserController extends Controller {
	protected function goLogin() {
		return 'login.php';
	}
}