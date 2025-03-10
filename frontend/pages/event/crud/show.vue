<template>
	<form-show hide-delete hide-edit with-helpdesk>
		<template
			v-slot:default="{ combos: { subdistricts, villages }, record }"
		>
			<div class="position-absolute" style="top: 0; right: 0">
				<v-chip class="mt-3 mr-4" color="blue" size="small">{{
					record.status
				}}</v-chip>
			</div>
			<v-card-text>
				<v-row dense>
					<v-row dense>
						<v-col cols="12">
							<v-text-field
								label="Name"
								v-model="record.name"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="6">
							<v-text-field
								label="Mulai"
								type="date"
								v-model="record.startdate"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="6">
							<v-text-field
								label="Selesai"
								type="date"
								v-model="record.finishdate"
								hide-details
								readonly
							></v-text-field>
						</v-col>

						<v-col cols="12">
							<v-combobox
								:items="subdistricts"
								:return-object="false"
								label="Kecamatan"
								v-model="record.subdistrict_id"
								hide-details
								readonly
							></v-combobox>
						</v-col>

						<v-col cols="12">
							<v-combobox
								:items="villages"
								:return-object="false"
								label="Kelurahan/Desa"
								v-model="record.village_id"
								hide-details
								readonly
							></v-combobox>
						</v-col>
					</v-row>
				</v-row>
			</v-card-text>
		</template>

		<template
			v-slot:info="{
				statuses: {
					hasPresence,
					hasPretest,
					hasPostest,
					isMember,
					isSpeaker,
				},
				record,
				theme,
			}"
		>
			<div class="text-overline mt-4">Aksi</div>
			<v-divider class="mb-3"></v-divider>

			<v-row dense v-if="isMember">
				<v-col cols="6">
					<v-dialog max-width="340">
						<template v-slot:activator="{ props: activatorProps }">
							<v-btn
								v-bind="activatorProps"
								:color="theme"
								:disabled="!hasPresence"
								variant="flat"
								block
								>absensi</v-btn
							>
						</template>

						<template v-slot:default="{ isActive }">
							<v-card
								prepend-icon="folder_check_2"
								text="Dengan meng-klik tombol absen, maka anda akan tercatat hadir pada event ini."
								title="Absen Kehadiran"
							>
								<template v-slot:actions>
									<v-btn
										color="deep-orange"
										text="Absen"
										@click="postPresence(isActive, record)"
									></v-btn>

									<v-btn
										text="Batal"
										@click="isActive.value = false"
									></v-btn>
								</template>
							</v-card>
						</template>
					</v-dialog>
				</v-col>

				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="$router.push({ name: 'mytraining-rundown' })"
						>rundown</v-btn
					>
				</v-col>

				<v-col cols="6">
					<v-btn
						:disabled="!hasPretest"
						:color="theme"
						variant="flat"
						block
						@click="
							$router.push({ name: 'mytraining-member-pretest' })
						"
						>pretest</v-btn
					>
				</v-col>

				<v-col cols="6">
					<v-btn
						:disabled="!hasPostest"
						:color="theme"
						variant="flat"
						block
						@click="
							$router.push({ name: 'mytraining-member-postest' })
						"
						>postest</v-btn
					>
				</v-col>
			</v-row>

			<v-row dense v-if="isSpeaker">
				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="
							$router.push({ name: 'mytraining-participant' })
						"
						>peserta</v-btn
					>
				</v-col>

				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="$router.push({ name: 'mytraining-rundown' })"
						>rundown</v-btn
					>
				</v-col>

				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="$router.push({ name: 'mytraining-pretest' })"
						>pretest</v-btn
					>
				</v-col>

				<v-col cols="6">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="$router.push({ name: 'mytraining-postest' })"
						>postest</v-btn
					>
				</v-col>
			</v-row>
		</template>
	</form-show>
</template>

<script>
export default {
	name: "mytraining-event-show",

	methods: {
		postPresence: function (isActive, record) {
			isActive.value = false;

			this.$http(`mytraining/api/event/${record.id}/presence`, {
				method: "POST",
				params: record,
			}).then(() => {
				this.$router.push({ name: "mytraining-event" });
			});
		},
	},
};
</script>
