import axios from "../../js/axios.js";
import router from "../../js/router.js"

export default {
	namespaced: true,
	state: () =>({
		boardList : []
		,page : 0
		,isLoading : true
		,boardDetail : {}
		,isModalLoading : true
		,controllFlg : true
		,lastPageFlg : false
	})
	,mutations: {
		setBoardList(state, boardList){
			state.boardList = state.boardList.concat(boardList);			
		},setPage(state, page){
			state.page = page;
		}
		,setBoardListUnshift(state, boardList){
			state.boardList.unshift(boardList);
		}
		,setIsLoading(state, loading){
			state.isLoading = loading;
		}
		,setBoardDetail(state, boardData){
			state.boardDetail = boardData;
		}
		,setIsModalLoading(state, loading){
			state.isModalLoading = loading;
		}
		,setControllFlg(state, flg){
			state.controllFlg = flg;
		}
		,setLastPage(state, page){
			state.lastPage = page;
		}
		,setLastPageFlg(state, flg){
			state.lastPageFlg = flg;
		}
	}
	,actions: {
		/**
		 * 게시글 획득
		 * 
		 * @param {*} context
		 */
		boardListPagenation(context){
			context.dispatch('user/chkTokenAndContinueProcess', () => {
				if(!context.state.controllFlg){
					return;
				} 
	
				if(context.state.lastPageFlg) {
					return;
				}
	
				context.commit('setControllFlg', false);	
				const url = '/api/boards?page='+ context.getters['getNextPage'];
				const config ={
					headers: {
						'Authorization' : 'Bearer ' + localStorage.getItem('accessToken')
					}
				}	
	
				context.commit('setIsLoading', true);
	
				axios.get(url,config)
				.then(response => {			
					context.commit('setPage', response.data.boardList.current_page);
					context.commit('setBoardList', response.data.boardList.data);
	
					if(response.data.boardList.current_page >= response.data.boardList.last_page){
						context.commit('setLastPageFlg', true);
					}
				})
				.catch(error => {
					context.commit('setIsLoading', true);
					console.log(error.response);
				}).finally(()=>{
					context.commit('setControllFlg', true);
					context.commit('setIsLoading', false);
				});
			}, {root:true});
		},
		/**
		 * 게시글 상세 정보 획득
		 * 
		 * @param {*} context 
		 * @param {*} id 
		 */
		showBoard(context, id){
			context.commit('setIsModalLoading', true);

			context.dispatch('user/chkTokenAndContinueProcess', () => {
				const url = '/api/boards/' + id
				const config ={
					headers: {
						'Authorization' : 'Bearer ' + localStorage.getItem('accessToken')
					}
				}				

				axios.get(url, config)
				.then(response => {
					context.commit('setBoardDetail', response.data.board);
					
					context.commit('setIsModalLoading', false);
				}).catch(error => {
					context.commit('setIsModalLoding', true);
					console.log(error.response);
				});
			}, {root:true});
		},
		/**
		 * 게시글 작성
		 * @param {*} context 
		 * @param {*} data 
		 */
		storeBoard(context, data){
			context.dispatch('user/chkTokenAndContinueProcess', () => {
				if(!context.state.controllFlg) return;

				context.commit('setControllFlg', false);

				const url = '/api/boards';
				const config ={
					headers: {
						'Content-Type' : 'multipart/form-data' // 파일을 삽입할 때만 json이 아닌 form-data 형식으로 보내는 거임
						,'Authorization' : 'Bearer ' + localStorage.getItem('accessToken')
					}
				}

				const formData = new FormData();
				formData.append('content', data.content);
				formData.append('file', data.file);

				axios.post(url, formData, config)
				.then(response => {
					context.commit('setBoardListUnshift', response.data.board);
					context.commit('user/setUserInfoBoardsCount', null, {root:true});
					router.replace('/boards');
				}).catch(error => {
					console.error(error.response);
				}).finally(()=>{
					context.commit('setControllFlg', true);
				});
			}, {root:true});
		}
	}
	,getters: {
		getNextPage(state){
			return state.page + 1;
		}
	}
}