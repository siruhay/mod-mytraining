<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-textarea
							label="Pertanyaan"
							v-model="record.name"
							hide-details
							readonly
						></v-textarea>
					</v-col>

					<v-col cols="12">
						<div class="text-overline mt-4">PILIHAN JAWABAN</div>
					</v-col>

					<v-col cols="12">
						<v-radio-group
							v-model="record.answerkey"
							hide-details
							readonly
						>
							<v-sheet
								class="d-flex flex-column"
								v-for="(option, optionIndex) in record.options"
								:key="optionIndex"
							>
								<v-radio
									:label="`Jawaban ${option.key}`"
									:value="option.key"
									readonly
								></v-radio>

								<div class="pl-10 mb-2">
									<v-textarea
										rows="2"
										hide-details
										v-model="option.text"
										readonly
									></v-textarea>
								</div>
							</v-sheet>
						</v-radio-group>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "mytraining-postest-show",
};
</script>
