<template>
	<!-- header -->
	<header>
		<div class="header-container">
			<div class="header-content">
				<div class="title">
					<a href=""><h1>Vuestagram</h1></a>
				</div>
				<img src="/logo.png" alt="logo" class="img-logo" style="background-color: transparent;">
				<div class="btn-group">
					<router-link to="/login"><a href=""><button class="btn btn-header btn-bg-black">로그인</button></a></router-link>
					<router-link to="/ragistration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
				</div>
			</div>
		</div>
	</header>
	<!-- main -->
	<main>
		<UserInfoComponent/>
		<div class="container">
			<router-view/>
		</div>
	</main>
	<!-- footer -->
	<footer>
		<p>copyright by WS</p>
	</footer>
</template>
<script setup>
	import UserInfoComponent from './user/UserInfoComponent.vue';
</script>
<style>
	@import url('../../css/common.css');
</style>