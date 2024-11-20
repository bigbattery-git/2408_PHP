<template>
	<!-- 카드 -->
	<div v-for="(value) in products" :key="value">
		<div class="card" style="background-color: black; color: white; width: 40%; margin: auto; padding: 20px;">
			<h1>{{ value.productName }}</h1>
			<h2>{{ value.productContent }}</h2>
			<h3>{{ `${value.productPrice.toLocaleString()} 원` }}</h3>
			<button @click="() => {alertDetailModal(value)}">지금 바로 구매!</button>
		</div>
    <hr>
  </div>

	<Transition name="detailModalAnimation">
		<!-- 상세페이지 모달창 -->
		<div class="bg-modal-black" v-show="flgDetail">
			<div class="bg-modal-white">
				<h1>{{ `제목 : ${detailProduct.productName}` }}</h1>
				<p>{{ `설명 : ${detailProduct.productContent}` }}</p>
				<p>{{ `가격 : ${detailProduct.productPrice} 원` }}</p>
				<button @click="() => {closeDetailModal(value)}">뒤고라기</button>
			</div>
		</div>
	</Transition>
</template>

<script setup>
// card===================================================
import { computed, ref } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();
	const products = computed(() => store.state.board.products);
	const detailProduct = computed(() => store.state.board.detailProduct);

// modal ==================================================

const flgDetail = ref(false);

// const openDetailModal = function(item){
// 	store.commit('board/setDetailProduct', item);
// 	flgDetail.value = true;
// }

const alertDetailModal = function(item){
	store.commit('board/setDetailProduct', item);
	alert(`이름 : ${item.productName}\n설명 : ${item.productContent}\n가격 : ${item.productPrice}`);
}

const closeDetailModal = function(){
	flgDetail.value = false;
}
</script>

<style>
	.bg-modal-black{
		width: 100vw;
		height: 200vh;
		background-color: rgb(0, 0, 0, 0.7);
		position: fixed;
		top: 0;
		left: 0;
	}
	.bg-modal-white{
		background-color: white;
		width: 80%;
		max-width: 300px;
		margin: 20px auto;
		padding: 20px;
	}

	/* 해당 요소가 등장할 때 주는 애니메이션 */
	/* 애니메이션 시작 전 */
	.detailModalAnimation-enter-from{
		opacity : 0;
	}
	/* 애니메이션 활성화 중 */
	.detailModalAnimation-enter-active{
		transition: 1s ease;
	}
	/* 애니메이션 끝날 때 */
	.detailModalAnimation-enter-to{
		opacity: 1;
	}

	/* 해당 요소가 사라질 때 주는 애니메이션 */
	.detailModalAnimation-leave-from{
		transform: translateY(0px);
		opacity: 1;
	}
	.detailModalAnimation-leave-active{
		transition: all 1s ease;
	}
	.detailModalAnimation-leave-to{
		transform: translateY(-100px);
		opacity: 0;
	}
</style>