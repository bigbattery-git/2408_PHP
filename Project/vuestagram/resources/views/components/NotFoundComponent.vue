<template>
	<h1>404뜸 ㅅㄱ</h1>
	<router-link to="/board/create">
		<button class="btn btn-bg-black" @click="goBack">뒤로가기</button>
	</router-link>
</template>
<script setup>
import { useRouter } from 'vue-router';

	const router = useRouter();

	const goBack = () => {
		router.back();
	};
</script>
<style>
	@import url('../../css/common.css');
</style>