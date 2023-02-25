<template>
    <Navbar></Navbar>
    <div class="w-11 flex justify-content-center m-3">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="style" header="Style"></Column>
            <Column field="competition" header="Competition"></Column>
            <Column field="ageGroup" header="Age Group"></Column>
            <Column field="startTime" header="Start Time" sortable></Column>
            <Column field="sex" header="Sex"></Column>
            <Column field="participants" header="Participants"></Column>
            <template #footer>
                In total there are
                {{ competitions ? competitions.length : 0 }} competitions.
            </template>
        </DataTable>
        <Confirm></Confirm>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { getCompetitions, competitions } from "./consts/getOrDelete.js";
onMounted(async () => {
    getCompetitions();
});
</script>
