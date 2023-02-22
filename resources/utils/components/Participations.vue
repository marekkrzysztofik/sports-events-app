<template>
  <Navbar></Navbar>
  <DataTable :value="participations" responsiveLayout="scroll">
            <template #header>Participations </template>
            <Column field="id" header="ID"></Column>
        </DataTable>
</template>
<script setup>
import { onMounted } from "vue";
import {
  getParticipations, participations
} from "../consts/getOrDelete.js";
onMounted(async () => {
  getParticipations();
});
</script>