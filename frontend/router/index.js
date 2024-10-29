export default {
	path: "/mytraining",
	meta: { requiredAuth: true },
	component: () =>
		import(
			/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/Base.vue"
		),
	children: [
		{
			path: "",
			redirect: { name: "mytraining-dashboard" },
		},

		{
			path: "dashboard",
			name: "mytraining-dashboard",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/dashboard/index.vue"
				),
		},

		// pagename
		// {
		// 	path: "pagename",
		// 	component: () =>
		// 		import(
		// 			/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/pagename/index.vue"
		// 		),
		// 	children: [
		// 		{
		// 			path: "",
		// 			name: "mytraining-pagename",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/pagename/crud/data.vue"
		// 				),
		// 		},

		// 		{
		// 			path: "create",
		// 			name: "mytraining-pagename-create",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/pagename/crud/create.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/edit",
		// 			name: "mytraining-pagename-edit",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/pagename/crud/edit.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/show",
		// 			name: "mytraining-pagename-show",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/pagename/crud/show.vue"
		// 				),
		// 		},
		// 	],
		// },
	],
};
