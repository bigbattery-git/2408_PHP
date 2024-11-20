
export default {
	namespaced: true,
	state: () =>({
		count: 0
		,products: [
			{productName : '바지', productPrice : 38000, productContent : '매우 아름다운 바지'}
			,{productName : '티셔츠', productPrice : 25000, productContent : '매우 아름다운 티셔츠'}
			,{productName : '양말', productPrice : 39999, productContent : '매우 비싼 양말'}
			,{productName : '모자', productPrice : 500000, productContent : '매우 매우 비싼 모자'}
		]
		,detailProduct: {
			productName : '', productPrice : 0, productContent : ''
		}
	})
	,mutations: {
		addCount(state){
			state.count++;
		}
		,setDetailProduct(state, item){
			state.detailProduct = item;
		}
	}
	,actions: {

	}
	,getters: {

	}
}