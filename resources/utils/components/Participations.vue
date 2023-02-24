<template>
    <Navbar></Navbar>
    <div class="flex">
        <ul class="no-list-style flex">
            <li class="m-3">
                <h1 class="m-0">{{ disciplineWithCompetitors.name }}</h1>
            </li>
            <li class="m-3">Style: {{ disciplineWithCompetitors.style }}</li>
            <li class="m-3">
                Competition:
                {{ disciplineWithCompetitors.competition }}
            </li>
            <li class="m-3">
                Age Group:
                {{ disciplineWithCompetitors.ageGroup }}
            </li>
            <li class="m-3">
                Start Time:
                {{ disciplineWithCompetitors.startTime }}
            </li>
            <li class="m-3">Sex: {{ disciplineWithCompetitors.sex }}</li>
            <li class="m-3">
                Participants:
                {{ disciplineWithCompetitors.participants }}
            </li>
            <li class="m-3">
                Time Not Score:
                {{ disciplineWithCompetitors.timeNotScore }}
            </li>
            <li class="m-3">
                Big Score Wins:
                {{ disciplineWithCompetitors.bigScoreWins }}
            </li>
        </ul>
    </div>
    <div class="flex justify-content-center">
        <DataTable
            :value="disciplineWithCompetitors.sportsman"
            :sort-field="scoreField"
            :sortOrder="scoreOrder"
            responsiveLayout="scroll"
            class="w-6"
        >
            <template #header>Competitors </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="surname" header="Surname"></Column>
            <Column field="age" header="Age"></Column>
            <Column field="sex" header="Sex"></Column>
            <template #footer>
                In total there are
                {{
                    disciplineWithCompetitors.sportsman
                        ? disciplineWithCompetitors.sportsman.length
                        : 0
                }}
                competitors.
            </template>
        </DataTable>
        <DataTable
            :value="participation"
            @sort="sortCompetitors"
            responsiveLayout="scroll"
            class="w-2"
        >
            <template #header>Scores </template>
            <Column field="sportsman_id" header="ID"></Column>
            <Column field="score" header="Score" sortable></Column>
            <Column field="time" header="Time" sortable></Column>
        </DataTable>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
onMounted(async () => {
    getDisciplineWithCompetitors();
    getParticipation();
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const scoreField = ref("");
const scoreOrder = ref("");
function sortCompetitors(event) {
    scoreField.value = "id";
    scoreOrder.value = event.sortOrder;
}
const participation = ref();
const getParticipation = async () => {
    const response = await axios.get(`/api/getParticipationByDisc/${props.id}`);
    participation.value = response.data;
    console.log(participation.value);
};
const disciplineWithCompetitors = ref({});
const getDisciplineWithCompetitors = async () => {
    const response = await axios.get(`/api/discWithSportsman/${props.id}`);
    disciplineWithCompetitors.value = response.data;
    console.log(disciplineWithCompetitors.value);
    //id.value = response.data.id;
    // form.value = response.data;
};
</script>
