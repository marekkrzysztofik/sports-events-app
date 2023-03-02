<template>
    <Navbar></Navbar>
    <Toast />
    <div class="w-11 flex justify-content-center m-3">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="style" header="Style"></Column>
            <Column field="competition" header="Competition"></Column>
            <Column field="minAge" header="MinAge"></Column>
            <Column field="maxAge" header="MaxAge"></Column>
            <Column field="startTime" header="Start Time" sortable></Column>
            <Column field="sex" header="Sex"></Column>
            <Column field="participants" header="Participants"></Column>
            <template #footer>
                In total there are
                {{ competitions ? competitions.length : 0 }} competitions.
            </template>
        </DataTable>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useCustomToast } from "./useCustomToast";
import { competitions, getDisciplinesByUserId } from "../consts/getOrDelete";
const { siemaFromToast } = useCustomToast();
onMounted(async () => {
    getDisciplinesByUserId();
    setTimeout(() => {
        siemaFromToast();
    }, 2000);
});
</script>
