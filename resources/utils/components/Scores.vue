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
                    <InputText
                        v-model="participationForm.time"
                        type="time"
                        placeholder="Time"
                        step="2"
                        class="m-3"
                    />
                    <div class="save-button m-3">
                        <Button
                            @click="saveScore"
                            label="Save"
                            class="p-button-rounded"
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
    score: 0,
    time: "",
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
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

const saveScore = async () => {
    console.log(sportsmanWithDisc.value.disciplines[partIds.indexOf(participationForm.value.id)].timeNotScore)
    // participationForm.value.discipline_id =
    //     participation.value[
    //         partIds.indexOf(participationForm.value.id)
    //     ].discipline_id;
    // await axios
    //     .post(`/api/createOrUpdateParticipation`, {
    //         ...participationForm.value,
    //     })
    //     .then(() => {
    //         Object.keys(participationForm.value).forEach(
    //             (key) => (participationForm.value[key] = "")
    //         );
    //         router.push("/admin/");
    //     });
};
</script>
<style scoped>
.actions-height {
    height: 21.5px;
}
.assign-width {
    width: 120px;
}
</style>
