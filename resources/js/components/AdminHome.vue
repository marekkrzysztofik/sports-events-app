<template>
    <DataTable
        :value="competitions"
        responsiveLayout="scroll"
        class="datatable w-max m-20-auto"
    >
        <template #header>Competitions </template>
        <Column
            v-for="column in disciplineColumns"
            :key="column.field"
            :field="column.field"
            :header="column.header"
            sortable
        ></Column>
        <template #footer>
            In total there are
            {{ count }} competitions.
        </template>
    </DataTable>
</template>
<script setup>
import { onMounted } from "vue";
import { useCompetitions } from "utils/composables/useCompetitions.js";
import { useComputed } from "utils/composables/useComputed";
import { disciplineColumns } from "utils/consts/disciplineColumns.js";

const { getCompetitionsByUserId, competitions } = useCompetitions();
const { count } = useComputed(competitions);
onMounted(async () => {
    getCompetitionsByUserId();
});
</script>
 