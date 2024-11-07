(()=>{
	const btn = document.querySelectorAll('.my-btn-detail');

	btn.forEach((a, i) => {
		a.addEventListener('click', (e) => {
			const URL = `/boards/detail?b_id=${e.target.value}`;
			axios.get(URL)
			.then(response => {
				const data = response.data

				document.querySelector('#modalTitle').textContent = data.b_title;
				document.querySelector('#modalName').textContent = data.u_name;
				document.querySelector('#modalContent').textContent = data.b_content;
				document.querySelector('#modalImg').setAttribute('src', data.b_img);
			})
			.catch(error => console.error(error))
			;

		});
	});

	const btnInsert = document.querySelector('#btnInsert');
	const inputBoardType = document.querySelector('#inputBoardType');
	btnInsert.style.cursor = 'pointer';
	btnInsert.addEventListener('click', (e)=>{
		window.location = `/boards/insert?bc_type=${inputBoardType.value}`;
	})
})();