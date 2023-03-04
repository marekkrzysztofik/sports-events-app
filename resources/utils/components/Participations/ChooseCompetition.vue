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
    </div>
</template>
<script setup>
import {
    getDisciplinesByUserId,
    competitions,
    competitors,
    getCompetitorsByUserId,
} from "../../consts/getOrDelete.js";
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";
const router = useRouter();
onMounted(async () => {
    getDisciplinesByUserId();
    getCompetitorsByUserId();
    console.log(competitions.value);
});
const selectedDiscipline = ref();
const disciplineWithCompetitors = ref({});
const filteredCompetitors = ref([]);

const showCompetitors = async () => {
    const response = await axios.get(
        `/api/getDisciplinesWithSportsman/${selectedDiscipline.value.id}`
    );
    disciplineWithCompetitors.value = response.data;
    if (disciplineWithCompetitors.value.sportsman.length > 0) {
        competitors.value.forEach((competitor) => {
            disciplineWithCompetitors.value.sportsman.forEach((sportsman) => {
                if (
                    competitor.age >= selectedDiscipline.value.minAge &&
                    competitor.age <= selectedDiscipline.value.maxAge &&
                    competitor.sex == selectedDiscipline.value.sex &&
                    sportsman.id != competitor.id
                ) {
                    filteredCompetitors.value.push(competitor);
                }
            });
        });
    } else {
        competitors.value.forEach((competitor) => {
            if (
                competitor.age >= selectedDiscipline.value.minAge &&
                competitor.age <= selectedDiscipline.value.maxAge &&
                competitor.sex == selectedDiscipline.value.sex
            ) {
                filteredCompetitors.value.push(competitor);
            }
        });
    }
};

const save = async () => {
    // await saveParticipation();
    // if (success.value == 1) {
    //     router.push("/admin");
    // }
    // success.value = 0;
};
</script>
