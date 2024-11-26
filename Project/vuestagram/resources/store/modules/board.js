import axios from "../../js/axios.js"

export default {
	namespaced: true,
	state: () =>({
		boardList : []
		,page : 0
		,isLoading : true
	})
	,mutations: {
		setBoardList(state, boardList){
			state.boardList = boardList;			
		},setPage(state, page){
			state.page = page;
		}
		,addBoardList(state, boardList){
			state.boardList.push(boardList);
		}
		,setIsLoading(state, loading){
			state.isLoading = loading;
		}
	}
	,actions: {
		/**
		 * 게시글 획득
		 * 
		 * @param {*} context
		 */
		getBoardListPagenation(context){			
			const url = '/api/boards?page='+ context.getters['getNextPage'];
			const config ={
				headers: {
					'Authorization' : 'Bearer ' + localStorage.getItem('accessToken')
				}
			}
			axios.get(url,config)
			.then(response => {
				// 로딩 전
				context.commit('setIsLoading', true);
				console.log('loading : ' + context.state.isLoading);

				context.commit('setBoardList', response.data.boardList.data);
				context.commit('setPage', response.data.boardList.current_page);

				// 로딩 후
				context.commit('setIsLoading', false);
				console.log('loading : ' + context.state.isLoading);
			})
			.catch(error => {
				console.log(error.response);
			});
		}
	}
	,getters: {
		getNextPage(state){
			return state.page + 1;
		}
	}
}