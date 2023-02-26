<template>
    <Navbar></Navbar>
    <div class="flex flex-column center">
        <h2>Sign competitor to competition</h2>
        <div
            class="flex w-11 m-auto justify-content-around bg-dark-blue br-radius-15"
        >
            <div class="m-3">
                <Dropdown
                    :options="ComptitorsIds"
                    inputClass="string"
                    placeholder="Select competitor"
                    v-model="participationForm.sportsman_id"
                    class="m-3"
                />
                <DataTable
                    :value="competitors"
                    responsiveLayout="scroll"
                    :scrollable="true"
                    scrollHeight="300px"
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
            <div class="m-3">
                <Dropdown
                    :options="ComptitionIds"
                    inputClass="string"
                    placeholder="Select competition"
                    v-model="participationForm.discipline_id"
                    class="m-3"
                />
                <Button
                    @click="save"
                    label="Save"
                    class="p-button-rounded m-3"
                />
                <DataTable
                    :value="competitions"
                    responsiveLayout="scroll"
                    :scrollable="true"
                    scrollHeight="300px"
                    class="pad-30-0"
                >
                    <template #header>Competitions </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="style" header="Style"></Column>
                    <Column field="competition" header="Competition"></Column>
                    <Column field="ageGroup" header="Age Group"></Column>
                    <Column field="startTime" header="Start Time"></Column>
                    <Column field="sex" header="Sex"></Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>
<script setup>
import {
    getCompetitions,
    competitions,
    competitors,
    getCompetitors,
} from "../../consts/getOrDelete.js";
import {
    ComptitionIds,
    ComptitorsIds,
    participationForm,
    saveParticipation,
    success,
} from "../../composables/chooseCompetition.js";
import { useRouter } from "vue-router";
import { onMounted } from "vue";
const router = useRouter();
onMounted(async () => {
    getCompetitions();
    ComptitionIds.splice(0)
    for (let i = 0; i < competitions.value.length; i++) {
        if (!ComptitionIds.includes(competitions.value[i].id))
            ComptitionIds.push(competitions.value[i].id);
    }
});
onMounted(async () => {
    getCompetitors();
    ComptitorsIds.splice(0)
    for (let i = 0; i < competitors.value.length; i++) {
        if (!ComptitorsIds.includes(competitors.value[i].id))
            ComptitorsIds.push(competitors.value[i].id); 
    }
});
const save = async () => {
    await saveParticipation();
    if (success.value == 1) {
        router.push("/admin");
    }
    success.value = 0;
};
</script>
