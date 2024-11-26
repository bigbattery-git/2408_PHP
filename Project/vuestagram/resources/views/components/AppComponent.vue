<template>
	<!-- header -->
	<header>
		<div class="header-container">
			<div class="header-content">
				<div class="title">
					<a href=""><h1>Vuestagram</h1></a>
				</div>
				<img src="/logo.png" alt="logo" class="img-logo" style="background-color: transparent;">
				<div class="btn-group" >
					<div v-if="!$store.state.user.authFlg">
						<router-link to="/login"><button class="btn btn-header btn-bg-black">로그인</button></router-link>
						<router-link to="/ragistration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
					</div>
					<div v-else>
						<button class="btn btn-header btn-bg-black" @click="$store.dispatch('user/logout')">로그아웃</button>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- main -->
	<main>
		<UserInfoComponent v-if="$store.state.user.authFlg"/>
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
	import { onMounted, onBeforeUnmount } from 'vue';

	let isReloading = false;

	// 새로 고침 여부 체크
	window.addEventListener('beforeunload', (event) => {
		isReloading = true;
	});

	const clearLocalStorage = () => {
		if (!isReloading) {
			localStorage.clear();
		}
	};

	onMounted(() => {
		window.addEventListener('unload', clearLocalStorage);
	});

	onBeforeUnmount(() => {
		window.removeEventListener('unload', clearLocalStorage);
	});

</script>
<style>
	@import url('../../css/common.css');
</style>