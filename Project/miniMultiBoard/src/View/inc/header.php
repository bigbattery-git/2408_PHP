<header>
	<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="/boards?bc_type=0">미니보드</a>
			<?php if(!($_GET['url'] === 'login' || $_GET['url'] === 'regist')) { ?>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							게시판타입
						</a>
						<ul class="dropdown-menu bg-dark" data-bs-theme="dark">
							<?php foreach($this->arrBoardNameInfo as $value) {	?>
								<li><a class="dropdown-item" href="<?php echo '/boards?bc_type='.$value['bc_type']?>"><?php echo $value["bc_name"] ?></a></li>
							<?php	}	?>
						</ul>
					</li>
				</ul>
				<a class="navbar-nav nav-link text-light" href="/logout" role="button">로그아웃</a>
			</div>
			<?php }	?>
		</div>
	</nav>
</header>