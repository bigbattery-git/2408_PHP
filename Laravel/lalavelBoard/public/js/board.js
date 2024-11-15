(()=>{

	const btn = document.querySelectorAll('.my-btn-detail');

	btn.forEach((node, i)=>{
		node.addEventListener('click', e=>{
			axios.get(`/boards/${e.target.value}`)
			.then(data => {
				document.querySelector('#modalTitle').textContent = data.data.b_title;
				document.querySelector('#modalUser').textContent = data.data.u_name;
				document.querySelector('#modalCreatedAt').textContent = data.data.created_at;
				document.querySelector('#modalContent').textContent = data.data.b_content;
				document.querySelector('#modalImg').setAttribute('src', data.data.b_img);
			})
			.catch(error => console.log(`에러남 인생망함 ㅅㄱ : ${error}`));
		})
	});

	const creater = document.querySelector('#creater');

	creater.addEventListener('click', ()=>{
		window.location = `http://127.0.0.1:8000/boards/create?bc_type=${document.querySelector("#bc_type").value}`;
	});
})();