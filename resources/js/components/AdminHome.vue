<template>
    <Navbar></Navbar>
    <div class="w-11 flex justify-content-center m-3">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column
                v-for="column in disciplineColumns"
                :key="column.field"
                :field="column.field"
                :header="column.header"
            ></Column>
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
import { useComputed } from "../../utils/composables/useComputed";
import { disciplineColumns } from "../../utils/consts/disciplineColumns.js";
const { getCompetitionsByUserId, competitions } = useCompetitions();
const { count } = useComputed(competitions);
onMounted(async () => {
    getCompetitionsByUserId();
    console.log(user.value);
});
</script>
