<template>
    <Navbar></Navbar>
    <div class="flex">
        <ul class="no-list-style flex">
            <li class="m-3">
                <h1 class="m-0">{{ discipline.name }}</h1> 
            </li>
            <li class="m-3">Style: {{ discipline.style }}</li>
            <li class="m-3">
                Competition:
                {{ discipline.competition }}
            </li>
            <li class="m-3">
                Age Group:
                {{ discipline.ageGroup }}
            </li>
            <li class="m-3">
                Start Time:
                {{ discipline.startTime }}
            </li>
            <li class="m-3">Sex: {{ discipline.sex }}</li>
            <li class="m-3">
                Participants:
                {{ discipline.participants }}
            </li>
            <li class="m-3">
                Time Not Score:
                {{ discipline.timeNotScore }}
            </li>
            <li class="m-3">
                Big Score Wins:
                {{ discipline.bigScoreWins }}
            </li>
        </ul>
    </div>
    <div class="flex justify-content-center">
        <DataTable
            :value="participationsWithCompetitors"
            responsiveLayout="scroll"
            class="m-3"
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
                {{
                    participationsWithCompetitors
                        ? participationsWithCompetitors.length
                        : 0
                }}
                competitors.
            </template>
        </DataTable>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
onMounted(async () => {
    getParticipationWithCompetitors(); 
    getDiscipline();
});
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
    console.log(participationsWithCompetitors.value);
};
const discipline = ref("");
const getDiscipline = async () => {
    const response = await axios.get(`/api/getDisciplineById/${props.id}`);
    discipline.value = response.data;
    console.log(discipline.value);
};
</script>
