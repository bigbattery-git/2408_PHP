<template>
	<!-- 유저정보 -->

	<div class="board-list-box">
		<div class="item" @click="openModal" v-for="value in 5" :key="value">
			<img src="../../../../public/img/sample1.png" alt="">
		</div>
	</div>

	<!-- 상세 모달 -->
	<div class="board-detail-box" v-show="modalFlg">
		<div class="item">
			<img src="../../../../public/img/sample3.png" alt="">
			<hr>
			<p>내용임</p>
			<div class="etc-box">
				<span>작성자 : abc</span>
				<button @click="modalFlg=false">닫기</button>
			</div>
		</div>
	</div>
</template>
<script setup>
	import { ref } from 'vue';

	const modalFlg = ref(false);

	function openModal(){
		modalFlg.value = true;
	}
</script>	
<style>
	@import url('../../../css/boardList.css');	
</style>