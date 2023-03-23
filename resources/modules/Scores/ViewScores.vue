<template>
    <div class="flex flex-column">
        <div class="competition-grid">
            <div>
                <h2>{{ discipline.name }}</h2>
            </div>
            <div>
                <h2>{{ discipline.style }}</h2>
            </div>
            <div>
                <h2>{{ discipline.competition }}</h2>
            </div>
            <div class="w-max">
                <h2>{{ discipline.startTime }}</h2>
            </div>
        </div>
        <div
            v-if="participationsWithCompetitors.length > 0"
            class="flex justify-content-center"
        >
            <DataTable
                :value="participationsWithCompetitors"
                responsiveLayout="scroll"
                class="m-3 datatable"
                :sortField="'time'"
                :sortOrder="1"
            >
                <template #header>Competitors </template>
                <Column field="id" header="ParticipationID"></Column>
                <Column field="sportsman_id" header="SportsmanID"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="surname" header="Surname"></Column>
                <Column field="age" header="Age"></Column>
                <Column field="sex" header="Sex"></Column>
                <Column
                    v-if="discipline.timeNotScore == 0"
                    field="score"
                    header="Score"
                    sortable
                ></Column>
                <Column
                    v-if="discipline.timeNotScore == 1"
                    field="time"
                    header="Time"
                    sortable
                ></Column>
                <template #footer>
                    In total there are
                    {{ count }}
                    competitors.
                </template>
            </DataTable>
        </div>
        <div v-if="participationsWithCompetitors.length == 0" class="center">
            <h1>No sportsman is assigned to this competition</h1>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { useComputed } from "utils/composables/useComputed";
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const participationsWithCompetitors = ref([]);
const getParticipationWithCompetitors = async () => {
    const response = await axios.get(
        `/api/participationJoinedWithCompetitors/${props.id}`
    );
    participationsWithCompetitors.value = response.data;
};
const { count } = useComputed(participationsWithCompetitors);
onMounted(async () => {
    getParticipationWithCompetitors();
    getDiscipline();
});
const discipline = ref("");
const getDiscipline = async () => {
    const response = await axios.get(`/api/getDisciplineById/${props.id}`);
    discipline.value = response.data;
};
</script>

