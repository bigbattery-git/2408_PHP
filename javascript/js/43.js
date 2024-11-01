const axios = import('./node_modules/axios/index.d.cts').default;

const BTN_CALL = document.querySelector('#btn_call');
BTN_CALL.addEventListener('click', getList);

function getList(){
	const URL = document.querySelector('#url').value;
	
	axios.get(document.querySelector('#url').value)
	.then(data => console.log(data.data))
	.catch(error => console.log(error));
}