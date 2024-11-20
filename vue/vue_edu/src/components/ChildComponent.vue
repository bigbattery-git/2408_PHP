<template>
	<h1>자식 컴포넌트 death</h1>
	<div v-for="value in props.data" :key="value">
		<span>{{ `이름 : ${value.name}` }}</span>
	</div>
	<p>{{ `부모카운트 : ${props.count}` }}</p>

	<slot>
		
	</slot>
</template>
<script setup>
	import {defineProps} from 'vue';

	const props = defineProps({
		data : Array
		,count : Number
	});
</script>
<style>
	
</style>