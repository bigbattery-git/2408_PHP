<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>자유게시판</title>
	<link rel="stylesheet" href="View/css/common.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
	<?php require_once('View/inc/header.php') ?>

	<div class="text-center mt-5 mb-5">
		<h1><?php echo $this->getBoardName(); ?></h1>
		<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
			<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
		</svg>
	</div>

	<main>
		
		<?php	foreach($this->getArrBoardList() as $item){	?>
			<div class="card">
				<img src="<?php echo $item['b_img']?>" class="card-img-top" style="height: 300px;" alt="...">
				<div class="card-body">
					<h5 class="card-title"><?php echo $item['b_title']?></h5>
					<p class="card-text"><?php echo $item['b_content']?></p>
					<button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal">상세로</button>
				</div>
			</div>
		<?php }	?>

	</main>
	<!-- Modal -->
	<div class="modal fade" id="detailModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">디자인이 너무 구려</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>살려줘</p>
					<br>
					<img src="https://images.unsplash.com/photo-1719937206094-8de79c912f40?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="card-img-top">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<footer class="py-3 fixed-bottom bg-dark">
    <p class="text-center text-white d-flex justify-content-center align-items-center">© 2024 Company, Inc</p>
  </footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>