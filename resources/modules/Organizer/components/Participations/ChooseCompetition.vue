<template>
    <Navbar />
    <div class="flex flex-column center">
        <h2>Sign competitor to competition</h2>
        <div
            class="flex w-9 m-auto justify-content-around bg-dark-blue br-radius-15"
        >
            <div class="m-3">
                <DataTable
                    :value="competitions"
                    v-model:selection="selectedDiscipline"
                    selectionMode="single"
                    dataKey="id"
                    responsiveLayout="scroll"
                    :scrollable="true"
                    scrollHeight="400px"
                    class="pad-30-0" 
                >
                    <template #header>Competitions </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="style" header="Style"></Column>
                    <Column field="competition" header="Competition"></Column>
                    <Column field="minAge" header="MinAge"></Column>
                    <Column field="maxAge" header="MaxAge"></Column>
                    <Column field="startTime" header="Start Time"></Column>
                    <Column field="sex" header="Sex"></Column>
                </DataTable>
            </div>
        </div>
        <Button
            @click="showCompetitors"
            label="Show Competitors"
            class="p-button-rounded m-3"
        />
        <div class="m-3">
            <DataTable
                :value="filteredCompetitors"
                v-model:selection="selectedCompetitors"
                selectionMode="multiple"
                dataKey="id"
                :metaKeySelection="false"
                responsiveLayout="scroll"
                :scrollable="true"
                scrollHeight="400px"
                class="pad-30-0 w-30rem"
            >
                <template #header>Competitors </template>
                <Column field="id" header="ID"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="surname" header="Surname"></Column>
                <Column field="age" header="Age"></Column>
                <Column field="sex" header="Sex"></Column>
            </DataTable>
        </div>
        <Button @click="save" label="Save" class="p-button-rounded m-3" />
    </div>
</template>
<script setup>
// import {
//     getDisciplinesByUserId,
//     competitions,
//     competitors,
//     getCompetitorsByUserId,
// } from "../../consts/getOrDelete.js";
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";
const router = useRouter();
onMounted(async () => {
    getDisciplinesByUserId();
    getCompetitorsByUserId();
});
const selectedDiscipline = ref();
const disciplineWithCompetitors = ref({});
const filteredCompetitors = ref([]);
const selectedCompetitors = ref();
const showCompetitors = async () => {
    const response = await axios.get(
        `/api/getDisciplinesWithSportsman/${selectedDiscipline.value.id}`
    );
    disciplineWithCompetitors.value = response.data;
    const existingIDS = disciplineWithCompetitors.value.sportsman.map(
        (sportsman) => {
            return sportsman.id;
        }
    );
    competitors.value.forEach((competitor) => {
        if (
            competitor.age >= selectedDiscipline.value.minAge &&
            competitor.age <= selectedDiscipline.value.maxAge &&
            competitor.sex == selectedDiscipline.value.sex
        ) {
            filteredCompetitors.value.push(competitor);
        }
    });
    filteredCompetitors.value = filteredCompetitors.value.filter(
        (competitor) => !existingIDS.includes(competitor.id)
    );
};
const save = async () => {
    const competitorsWithDisciplineID = selectedCompetitors.value.map(
        (competitor) => {
            return {
                discipline_id: selectedDiscipline.value.id,
                sportsman_id: competitor.id,
                time: "23:59:59",
                score: 0,
            };
        }
    );
    axios
        .post("/api/createOrUpdateParticipation", {
            ...competitorsWithDisciplineID,
        })
        .then(() => {
            router.push("/admin");
        });
};
</script>
