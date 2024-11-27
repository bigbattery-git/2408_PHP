import axios from '../../js/axios.js';
import router from '../../js/router.js'

export default {
	namespaced: true,
	state: () => ({
		// accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : ''
		authFlg: localStorage.getItem('accessToken') ? true : false
		,userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {}
	})
	,mutations: {
		// setAccessToken(state, action){
		// 	state.accessToken = action;
		// 	// 새로고침을 했을 때 데이터가 사라지지 않게 하기 위해
		// 	localStorage.setItem('accessToken', action);
		// },
		setAuthFlg(state, flg){			
			state.authFlg = flg;
		}
		,setUserInfo(state, userInfo){
			state.userInfo = userInfo;
		},setUserInfoBoardsCount(state){
			state.userInfo.boards_count ++;
			localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
		}
	}
	,actions: {
		/**
		 * 로그인 처리
		 * 
		 * @param {*} context
		 * @param {*} userInfo
		 */
		// context : 해당 모듈 전체. mutations, actions등 함수 포함
		login(context, userInfo){
			const url = 'api/login';

			// 통신할 때 문자열로 보내야해서 Json으로 바꿔서 보내는 것
			const data = JSON.stringify(userInfo);
			// const config = {
			// 	headers: {
			// 		'Content-Type': 'application/json'
			// 	}
			// }

			// axios.post(url, data, config)
			axios.post(url, data)
			.then(response =>{
				console.log(response);

				// context.commit('setAccessToken', response.data.accessToken);
				localStorage.setItem('accessToken', response.data.accessToken);
				localStorage.setItem('refreshToken', response.data.refreshToken);
				localStorage.setItem('userInfo', JSON.stringify(response.data.userInfo));
				context.commit('setAuthFlg', true);
				context.commit('setUserInfo', response.data.userInfo);

				router.replace('/boards');
			}).catch(error => {
				let errMsg = [];
				let errorData = error.response.data;

				if(error.response.status === 422){
					// 유효성 체크 에러
					'account' in errorData.data? errMsg.push(errorData.data.account[0]):'';
					'password' in errorData.data? errMsg.push(errorData.data.password[0]):'';
				} else if(error.response.status === 401){
					errMsg.push(errorData.msg);
				} else {
					errMsg.push(`웹 실행 안됨 ㅅㄱ : ${error.response.status}`);
				}

				console.log(error.response);
				alert(errMsg.join('\n'));
			})
		}
		
		/**
		 * 로그아웃 처리
		 * 
		 * @param {*} context
		 */
		,logout(context){
			// TODO 백앤드 처리 추가

			// accessToken은 파라미터 세팅 X
			// Header에 세팅해야 함

			let config = {
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('accessToken') //accessToken 보내는 법 
				}
			}
			let url = '/api/logout';
			axios.post(url, null, config)
			.then(response => {
				console.log(response.data);
				alert('로그아웃 성공');
				
				// 프론트에서 로그아웃 처리 방법 
				// 1. 그냥 프론트에서 로그아웃 처리하고 다시 로그인시키기 -> 일반적
				// 2. 재인증 절차를 거쳐서 로그아웃 시키기
			}).catch(error => {
				console.log(error.response);
				alert('문제가 발생하여 로그아웃 처리');
			}).finally(()=>{
				localStorage.clear();
				context.commit('setAuthFlg', false);
				context.commit('setUserInfo',{});
				router.replace('/login');
			});
		}
	}
	,getters: {
		
	}
}