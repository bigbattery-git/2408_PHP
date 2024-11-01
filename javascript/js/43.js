const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);

function getList(){
	const URL = document.querySelector('#url').value;
	let newURL = 'https://picsum.photos/v2/list'
	axios.get(URL)
	.then(response => {
		console.log(response.data);
		response.data.forEach(element => {
			const NEW = document.createElement('img');
			NEW.style.width = '200px';
			NEW.style.height = '300px';
			NEW.setAttribute('src', element.download_url);

			document.querySelector('.container').appendChild(NEW);
		});
	})
	.catch(error => console.log(error));
}

function getEmployees(){
	const URL = 'D:/WorkSpace/2408_PHP/php/Ex/107_select.php'

	axios.get(URL)
	.then(data => console.log(data))
	.catch(error => console.log(error))
	;
}