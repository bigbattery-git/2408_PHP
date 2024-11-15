@extends('layout.layout')

@section('title', '게시판')

@section('main')

@section('cssLink')
	<link rel="stylesheet" href="/css/common.css">
@endsection

@section('jsLink')
	<script src="/js/board.js" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
<input type="hidden" id="bc_type" name="bc_type" value="{{ $bc_type }}">
<div class="text-center mt-5 mb-5">
	<h1>{{ $title }}게시판</h1>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" id="creater">
		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
	</svg>
</div>

<main>
	@foreach ($datas as $item)
	<div class="card">
		<img src="{{ $item->b_img }}" class="card-img-top" style="height: 300px;" alt="...">
		<div class="card-body">
			<h5 class="card-title">{{ $item->b_title }}</h5>
			<p class="card-text">{{ $item->b_content }}</p>
			<h6 class="card-title" style="color: red">{{ $item->u_name }}</h6>
			<button value={{ $item->b_id }} type="button" class="btn btn-info text-white my-btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal">상세로</button>
		</div>
	</div>
	@endforeach
</main>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalTitle">디자인이 너무 구려</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<h2 style="color:red" id="modalUser"></h2>
			<h6 id="modalCreatedAt"></h6>
			<div class="modal-body">
				<p id="modalContent">살려줘</p>
				<br>
				<img id="modalImg" src="https://images.unsplash.com/photo-1719937206094-8de79c912f40?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="card-img-top">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection