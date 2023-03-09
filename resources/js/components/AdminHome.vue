<template>
    <Navbar></Navbar>
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
                {{ count }} competitions.
            </template>
        </DataTable>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useCompetitions } from "../../utils/composables/useCompetitions.js";
import { user } from "/resources/modules/Organizer/components/Auth/user.js";
import { useComputed } from '../../utils/composables/useComputed';
const { getCompetitionsByUserId, competitions } = useCompetitions();
const { count } = useComputed(competitions); 
onMounted(async () => {
    getCompetitionsByUserId();
    console.log(user.value);
});
</script>
