import {createWebHistory, createRouter } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import { useStore } from 'vuex';
import NotFoundComponent from '../views/components/NotFoundComponent.vue';

// to : 이동할 경로의 객체 정보
// from : 머물러있는 경로의 객체 정보
// next : 라우터 종료 후 후속처리
const chkAuth = function(to, from, next){
	const store = useStore();

	// 로그인 여부 플래그
	const authPassFlg = store.state.user.authFlg;

	// to.path 이동할 경로
	// 로그인 안했을 때 접속 가능한 경로
	const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration');

	if(authPassFlg && noAuthPassFlg){
		// 인증된 유저는 비인증 페이지로 접근할 경우 board로 보내버림
		next('/boards'); // next는 파라미터 말하는 것
	} else if(!authPassFlg && !noAuthPassFlg) {
		// 인증안된 유저가 인증된 페이지로 접근할 경우 login으로 보내버림
		next('/login');
	} else {
		next();
	}
}

const routes=[
	{
		path:'/'
		,redirect:'/login'
		,beforeEnter: chkAuth
	}
	,{
		path : '/login'
		,component : LoginComponent
		,beforeEnter: chkAuth
	}
	,{
		path: '/boards'
		,component : BoardListComponent
		,beforeEnter: chkAuth
	}
	,{
		path: '/boards/create'
		,component : BoardCreateComponent
		,beforeEnter: chkAuth
	}
	,{
		path:'/registration'
		,component : UserRegistrationComponent
		,beforeEnter: chkAuth
	}
	,{
		path:'/:catchAll(.*)'
		,component : NotFoundComponent
	}
];

const router = createRouter({
	history: createWebHistory()
	,routes
});

export default router;