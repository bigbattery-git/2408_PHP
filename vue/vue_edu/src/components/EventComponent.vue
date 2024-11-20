<template>
	<div>
		<p>자식쪽 cnt : {{ props.cnt }}</p>
		<button @click="$emit('eventAddCnt', 2)">asdfasdf</button>
		<button @click="$emit('eventAddCnt', 5)">자식쪽에서 개수 정해서 올리는 버튼</button>
		<button @click="$emit('eventAddCnt')">초기화임</button>
	</div>
</template>
<script setup>
	import { defineProps } from 'vue';

	const props = defineProps({
		cnt : Number
	});
</script>
<style>
	
</style>