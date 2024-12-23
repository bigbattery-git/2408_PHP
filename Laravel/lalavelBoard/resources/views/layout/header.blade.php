<header>
	<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">미니보드</a>
			@auth
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									게시판
								</a>
								<ul class="dropdown-menu bg-dark" data-bs-theme="dark">
									@foreach ($myGlobalBoardsCategoryInfo as $item)
										<li><a class="dropdown-item" href="{{ route('boards.index', ['bc_type' => $item->bc_type])}}">{{ $item->bc_name }}</a></li>
									@endforeach
								</ul>
							</li>
						</ul>
						<a class="navbar-nav nav-link text-light" href="{{ route('logout') }}" role="button">로그아웃</a>
				</div>						
			@endauth
			@guest
			<a class="navbar-nav nav-link text-light" href="#" role="button">회원가입</a>
			@endguest
		</div>
	</nav>
</header>