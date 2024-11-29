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
		},
		/**
		 * 회원가입
		 */
		registration(context, userInfo){
			const url = '/api/registration';
			const config = {
				headers: {
					'Content-Type' : 'multipart/form-data'
				}
			}

			// form data 세팅
			const formData = new FormData();
			formData.append('account', userInfo.account);
			formData.append('password', userInfo.password);
			formData.append('password_chk', userInfo.password_chk);
			formData.append('gender', userInfo.gender);
			formData.append('profile', userInfo.profile);
			formData.append('name', userInfo.name);

			axios.post(url, formData, config)
			.then(response => {
				alert('회원가입 성공\n가입하신 계정으로 로그인 해 주세요.');
				router.replace('/login');
			}).catch(error => {
				console.log(error.response);
				alert('회원가입 실패');
			});
		},
		/**
		 * 
		 * @param {*} context 
		 * @param {function} callbackProcess 
		 */
		chkTokenAndContinueProcess(context, callbackProcess){
			// 토큰 만료 확인
			const payload = localStorage.getItem('accessToken').split('.')[1];
			const base64 = payload.replace(/-/g, '+').replace(/_/g, '/'); // 정규식을 넣으면 전체가 다 바뀜
			const objPayload = JSON.parse(window.atob(base64));
			const now = new Date();
			// 토큰 재발급 및 콜백함수 실행

			if(objPayload.exp * 1000  > now.getTime()){
				// 토근 유효
				callbackProcess();
			} else {
				// 토큰 만료
				context.dispatch('reissueAccessToken', callbackProcess);				
			}
		},
		/**
		 * 토큰 재발급 처리
		 * @param {*} context 
		 * @param {function} callbackProcess 
		 */
		reissueAccessToken(context, callbackProcess){
			const url = '/api/reissue'
			const config = {
					headers: {
							'Authorization' : 'Bearer ' + localStorage.getItem('refreshToken')
					}
			};
			
			axios.post(url, null, config)
			.then(response => {
				localStorage.setItem('accessToken', response.data.accessToken);	
				localStorage.setItem('refreshToken', response.data.refreshToken);	
				// 토큰 세팅
				callbackProcess();
			})
			.catch(error => {
					console.error(error);
			});

			// 재발급 처리 후 원래 하려던 처리 이어서 함
		}
	}
	,getters: {
		
	}
}