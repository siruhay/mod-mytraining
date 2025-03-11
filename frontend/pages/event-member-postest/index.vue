<template>
	<page-blank page-name="mytraining-member-postest">
		<template v-slot:default="{ records }">
			<v-window v-model="queznum">
				<v-window-item
					v-for="(record, recordIndex) in records"
					:key="`card-${recordIndex}`"
				>
					<v-card class="px-12" elevation="0" height="420">
						<v-toolbar color="transparent">
							<v-toolbar-title
								>Pertanyaan
								{{ recordIndex + 1 }}</v-toolbar-title
							>
							<v-spacer></v-spacer>
						</v-toolbar>

						<v-card-text class="px-5 py-0">
							<v-sheet
								class="pa-4 d-flex justify-center align-center text-h5 font-weight-light"
								color="blue-lighten-5"
								rounded="lg"
								>{{ record.name }}</v-sheet
							>
						</v-card-text>

						<v-card-text class="px-5 pb-0">
							<div class="text-overline">pilihan jawaban</div>

							<v-radio-group v-model="record.answer">
								<v-radio
									v-for="(
										option, optionIndex
									) in record.options"
									:key="`option-${recordIndex}-${optionIndex}`"
									:label="option.text"
									:value="option.key"
								></v-radio>
							</v-radio-group>
						</v-card-text>

						<v-card-text class="px-5 py-0 d-flex">
							<v-btn
								v-if="record.answered_at === null"
								class="mr-2"
								color="blue"
								variant="flat"
								@click="postAnswer(record)"
								>KIRIM JAWABAN</v-btn
							>

							<v-btn
								color="green"
								variant="flat"
								@click="
									nextQuestion(recordIndex, records.length)
								"
								>BERIKUTNYA</v-btn
							>
						</v-card-text>
					</v-card>
				</v-window-item>
			</v-window>
		</template>
	</page-blank>
</template>

<script>
export default {
	name: "mytraining-member-postest",

	data: () => ({
		queznum: 0,
	}),

	methods: {
		nextQuestion: function (recordIndex, length) {
			if (recordIndex < length - 1) {
				this.queznum++;
				return;
			}

			this.queznum = 0;
		},

		postAnswer: function (record) {
			this.$http(
				`mytraining/api/event/${record.event_id}/member-postest/${record.id}`,
				{
					method: "PUT",
					params: {
						id: record.id,
						answer: record.answer,
					},
				}
			).then((response) => {
				record.answered_at = response.answered_at;
				this.queznum++;
			});
		},
	},
};
</script>
