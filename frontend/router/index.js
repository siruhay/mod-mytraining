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

		// event
		{
			path: "event",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-event",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-event-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event/crud/create.vue"
						),
				},

				{
					path: ":event/edit",
					name: "mytraining-event-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event/crud/edit.vue"
						),
				},

				{
					path: ":event/show",
					name: "mytraining-event-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event/crud/show.vue"
						),
				},
			],
		},

		// event/:event/postest
		{
			path: "event/:event/postest",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-postest/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-postest",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-postest/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-postest-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-postest/crud/create.vue"
						),
				},

				{
					path: ":postest/edit",
					name: "mytraining-postest-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-postest/crud/edit.vue"
						),
				},

				{
					path: ":postest/show",
					name: "mytraining-postest-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-postest/crud/show.vue"
						),
				},
			],
		},

		// event/:event/presence
		{
			path: "event/:event/presence",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-presence/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-presence",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-presence/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-presence-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-presence/crud/create.vue"
						),
				},

				{
					path: ":presence/edit",
					name: "mytraining-presence-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-presence/crud/edit.vue"
						),
				},

				{
					path: ":presence/show",
					name: "mytraining-presence-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-presence/crud/show.vue"
						),
				},
			],
		},

		// event/:event/pretest
		{
			path: "event/:event/pretest",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-pretest/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-pretest",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-pretest/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-pretest-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-pretest/crud/create.vue"
						),
				},

				{
					path: ":pretest/edit",
					name: "mytraining-pretest-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-pretest/crud/edit.vue"
						),
				},

				{
					path: ":pretest/show",
					name: "mytraining-pretest-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-pretest/crud/show.vue"
						),
				},
			],
		},

		// event/:event/rundown
		{
			path: "event/:event/rundown",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-rundown/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-rundown",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-rundown/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-rundown-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-rundown/crud/create.vue"
						),
				},

				{
					path: ":rundown/edit",
					name: "mytraining-rundown-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-rundown/crud/edit.vue"
						),
				},

				{
					path: ":rundown/show",
					name: "mytraining-rundown-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/event-rundown/crud/show.vue"
						),
				},
			],
		},

		// history
		{
			path: "history",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-history",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-history-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history/crud/create.vue"
						),
				},

				{
					path: ":history/edit",
					name: "mytraining-history-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history/crud/edit.vue"
						),
				},

				{
					path: ":history/show",
					name: "mytraining-history-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history/crud/show.vue"
						),
				},
			],
		},

		// history/:history/postest
		{
			path: "history/:history/postest",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-postest/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-history-postest",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-postest/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-history-postest-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-postest/crud/create.vue"
						),
				},

				{
					path: ":postest/edit",
					name: "mytraining-history-postest-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-postest/crud/edit.vue"
						),
				},

				{
					path: ":postest/show",
					name: "mytraining-history-postest-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-postest/crud/show.vue"
						),
				},
			],
		},

		// history/:history/presence
		{
			path: "history/:history/presence",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-presence/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-history-presence",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-presence/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-history-presence-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-presence/crud/create.vue"
						),
				},

				{
					path: ":presence/edit",
					name: "mytraining-history-presence-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-presence/crud/edit.vue"
						),
				},

				{
					path: ":presence/show",
					name: "mytraining-history-presence-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-presence/crud/show.vue"
						),
				},
			],
		},

		// history/:history/pretest
		{
			path: "history/:history/pretest",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-pretest/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-history-pretest",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-pretest/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-history-pretest-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-pretest/crud/create.vue"
						),
				},

				{
					path: ":pretest/edit",
					name: "mytraining-history-pretest-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-pretest/crud/edit.vue"
						),
				},

				{
					path: ":pretest/show",
					name: "mytraining-history-pretest-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-pretest/crud/show.vue"
						),
				},
			],
		},

		// history/:history/rundown
		{
			path: "history/:history/rundown",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-rundown/index.vue"
				),
			children: [
				{
					path: "",
					name: "mytraining-history-rundown",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-rundown/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "mytraining-history-rundown-create",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-rundown/crud/create.vue"
						),
				},

				{
					path: ":rundown/edit",
					name: "mytraining-history-rundown-edit",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-rundown/crud/edit.vue"
						),
				},

				{
					path: ":rundown/show",
					name: "mytraining-history-rundown-show",
					component: () =>
						import(
							/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/history-rundown/crud/show.vue"
						),
				},
			],
		},

		// report
		{
			path: "report",
			name: "mytraining-report",
			component: () =>
				import(
					/* webpackChunkName: "mytraining" */ "@modules/mytraining/frontend/pages/report/index.vue"
				),
		},
	],
};
