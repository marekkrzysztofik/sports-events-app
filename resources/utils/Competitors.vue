<template>
    <Navbar></Navbar>
    <div class="w-10 flex m-auto justify-content-center">
        <DataTable :value="competitors" responsiveLayout="scroll">
            <template #header>Competitors </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="surname" header="Surname"></Column>
            <Column field="age" header="Age"></Column>
            <Column field="sex" header="Sex"></Column>
            <template #footer>
                In total there are
                {{ competitors ? competitors.length : 0 }} competitors.
            </template>
        </DataTable>
        <Confirm></Confirm>
    </div>
</template>
<script setup> 
import { onMounted } from "vue";
import { competitors, getCompetitors } from "./consts/getOrDelete.js";
onMounted(async () => {
    getCompetitors();
});
</script>
