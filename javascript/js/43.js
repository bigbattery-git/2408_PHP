const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);

function getList(){
	const URL = document.querySelector('#url').value;
	
	axios.get(URL)
	.then(data => console.log(data))
	.catch(error => console.log(error));
}