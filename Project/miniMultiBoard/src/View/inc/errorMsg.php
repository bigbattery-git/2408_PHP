<div id="errorMsg" class="form-text text-danger">
	<?php
		// $this는 원래 클래스에서 쓸 수 있었는데 왜... 
		// 지금 여전히 Controller.php 내부라서 가능함
		// index.php에서 new Route\Route() 객체 생성 -> Route Construct 실행됨 -> 거기서 new UserController 실행됨 -> Controller의 Construct 실행됨 -> $require_once로 login.php 불러옴
		// -> 여전히 Controller 내부라서 $this로 사용가능 
		// 쉽게 정리하면 Route 실행 -> UserController 실행 -> Controller에서 Login.php 호출 
		echo implode('<br>', $this->arrErrorMsg);
	?>
</div>