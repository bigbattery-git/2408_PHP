<template>
	<div class="form-box">
		<p class="form-title">로그인</p>
		<input v-model="userInfo.account" type="text" name="account" placeholder="account">
		<input v-model="userInfo.password" type="password" name="password" placeholder="password">
		<!-- $store : app.js에 등록한 use(store)의 store을 쓰겠다는 의미 -->
		<!-- $store.dispatch('경로/action함수', 파라미터) : action에 등록한 함수를 실행하기 위해 사용하는 함수 -->
		<button @click="$store.dispatch('user/login', userInfo)" class="btn btn-submit btn-bg-black">Login</button>
	</div>
</template>
<script setup>

import { reactive } from 'vue';

	const userInfo = reactive({
		account: ''
		, password: ''
	})
</script>
<style>
	
</style>