<template>
	<form-show hide-edit hide-delete with-helpdesk>
		<template
			v-slot:default="{
				combos: { speakers },
				statuses: { speaker },
				record,
				theme,
			}"
		>
			<v-card-text>
				<v-row dense>
					<v-col cols="6">
						<v-text-field
							label="Tanggal"
							type="date"
							v-model="record.datemark"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="3">
						<v-text-field
							label="Mulai"
							type="time"
							v-model="record.starttime"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="3">
						<v-text-field
							label="Selesai"
							type="time"
							v-model="record.finishtime"
							hide-details
							readonly
						></v-text-field>
					</v-col>

					<v-col cols="12">
						<v-textarea
							label="Agenda"
							v-model="record.agenda"
							hide-details
							readonly
						></v-textarea>
					</v-col>

					<v-col cols="12">
						<v-select
							:items="speakers"
							label="Pembicara"
							v-model="record.speaker_id"
							hide-details
							readonly
						></v-select>
					</v-col>
				</v-row>
			</v-card-text>

			<div class="text-overline pl-4 mt-5">FILE LAMPIRAN</div>

			<v-card-text>
				<v-sheet
					v-for="(file, fileIndex) in record.files"
					:key="fileIndex"
					class="pa-1"
					:color="`${theme}-lighten-4`"
					rounded="pill"
				>
					<div class="d-flex align-center">
						<div class="px-4 flex-grow-1">{{ file }}</div>
						<v-btn :color="theme" size="small" icon>
							<v-icon>cloud_download</v-icon>
						</v-btn>
					</div>
				</v-sheet>

				<template v-if="speaker">
					<v-divider class="my-5"></v-divider>

					<v-row dense>
						<v-col cols="12">
							<v-file-input
								accept="application/pdf"
								label="File"
								v-model="record.file"
								show-size
							></v-file-input>
						</v-col>
					</v-row>

					<v-btn
						color="primary"
						block
						variant="flat"
						@click="uploadFile(record, store)"
						>UPLOAD</v-btn
					>
				</template>
			</v-card-text>
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "mytraining-rundown-show",

	methods: {
		uploadFile: function (record) {
			this.$http(`mytraining/api/rundown/${record.id}/upload`, {
				method: "POST",
				contentType: "multipart/form-data",
				params: {
					materi: record.file,
				},
			}).then(() => {
				this.$router.push({
					name: "mytraining-rundown",
				});
			});
		},
	},
};
</script>
