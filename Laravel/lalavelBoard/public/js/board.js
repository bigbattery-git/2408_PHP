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

				const modalDeleteParent = document.querySelector('#modalDeleteParent');

				modalDeleteParent.innerHTML = '';
				if(data.data.delete_flg){
					const newButton = document.createElement('button');
					newButton.setAttribute('type', 'button');
					newButton.setAttribute('data-bs-dismiss', 'modal');
					newButton.classList.add('btn');
					newButton.classList.add('btn-warning');
					newButton.classList.add('text-white');
					newButton.textContent = 'delete';

					newButton.addEventListener('click', ()=>{
						boardDestroy(e.target.value);
					});

					modalDeleteParent.appendChild(newButton);
				}
			})
			.catch(error => console.log(`에러남 인생망함 ㅅㄱ : ${error}`));
		})
	});
})();

function redirectInsert(button, type){
	window.location = `http://127.0.0.1:8000/boards/create?bc_type=${type}`;
	button.onclick = null;
}

function boardDestroy(b_id){
	axios.delete(`/boards/${b_id}`)
	.then(response => {
		if(response.data.success){
			const deleteNode = document.querySelector(`#card${b_id}`);
			deleteNode.remove();
		} else {
			alert('삭제 실패 ㅅㄱ');
		}
	})
	.catch(error => {
		console.log('에러남. ㅅㄱ : ' + error);
		alert('에러남. ㅅㄱ');
	});
}