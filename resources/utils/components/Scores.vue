<template>
    <Navbar></Navbar>
    <div class="flex justify-content-center m-4">
        <div class="m-3 w-5 pad-50-0 bg-dark-blue br-radius-15">
            <div class="flex justify-content-center">
                <DataTable
                    :value="sportsmanWithDisc.disciplines"
                    responsiveLayout="scroll"
                >
                    <template #header>Disciplines </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="style" header="Surname"></Column>
                    <Column field="competition" header="Age"></Column>
                </DataTable>
                <DataTable :value="participation" class="">
                    <template #header>Participation </template>
                    <Column field="id" header="ParticipationID"> </Column>
                </DataTable>
            </div>
        </div>
        <div class="m-3 w-5 flex pad-50-0 bg-dark-blue br-radius-15">
            <div class="flex">
                <div class="m-3">
                    <div class="m-3">
                        Name:
                        <h1 class="m-0">
                            <p class="m-0">{{ sportsmanWithDisc.name }}</p>
                        </h1>
                    </div>
                    <div class="m-3">
                        Age:
                        <h1 class="m-0">
                            <p class="m-0">{{ sportsmanWithDisc.age }}</p>
                        </h1>
                    </div>
                </div>
                <div class="m-3">
                    <div class="m-3">
                        Surname:
                        <h1 class="m-0">
                            <p class="m-0">{{ sportsmanWithDisc.surname }}</p>
                        </h1>
                    </div>
                    <div class="m-3">
                        Sex:
                        <h1 class="m-0">
                            <p class="m-0">{{ sportsmanWithDisc.sex }}</p>
                        </h1>
                    </div>
                </div>
                <div class="m-4 center">
                    <Dropdown
                        v-model="participationForm.id"
                        :options="partIds"
                        inputClass="string"
                        placeholder="Participation ID"
                        class="m-3"
                    />
                    <p>Enter time or score</p>
                    <InputText
                        v-if="timeNotScore == 1"
                        v-model="participationForm.time"
                        type="time"
                        placeholder="Time"
                        step="2"
                        class="m-3"
                    />
                    <InputText
                        v-else-if="timeNotScore == 0"
                        v-model="participationForm.score"
                        type="number"
                        placeholder="Score"
                        class="score-input m-3"
                    />
                    <div class="save-button m-3">
                        <Button
                            @click="show"
                            label="Show"
                            class="p-button-rounded m-2"
                        />
                        <Button
                            @click="saveScore"
                            label="Save"
                            class="p-button-rounded m-2"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
onMounted(async () => {
    getSportsmanWithDisc();
    getParticipation();
});

const participationForm = ref({
    id: "",
    discipline_id: "",
    sportsman_id: "",
    score: "",
    time: "",
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const timeNotScore = ref();
const partIds = [];
const sportsmanWithDisc = ref({});
const participation = ref([]);
const getSportsmanWithDisc = async () => {
    const response = await axios.get(`/api/sportsmanWithDisc/${props.id}`);
    sportsmanWithDisc.value = response.data;
};
const getParticipation = async () => {
    const response = await axios.get(`/api/getParticipationByComp/${props.id}`);
    participation.value = response.data;
    for (let i = 0; i < participation.value.length; i++) {
        partIds.push(participation.value[i].id);
    }
    participationForm.value.sportsman_id = props.id;
};
const show = () => {
    timeNotScore.value =
        sportsmanWithDisc.value.disciplines[
            partIds.indexOf(participationForm.value.id)
        ].timeNotScore;
};
const saveScore = async () => {
    participationForm.value.discipline_id =
        participation.value[
            partIds.indexOf(participationForm.value.id)
        ].discipline_id;
    await axios
        .post(`/api/createOrUpdateParticipation`, {
            ...participationForm.value,
        })
        .then(() => {
            Object.keys(participationForm.value).forEach(
                (key) => (participationForm.value[key] = "")
            );
            router.push("/admin/");
        });
};
</script>
<style scoped>
.actions-height {
    height: 21.5px;
}
.assign-width {
    width: 120px;
}
.score-input {
    width: 80px;
}
</style>
