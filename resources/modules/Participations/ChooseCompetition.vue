<template>
    <div class="flex flex-column center">
        <DataTable
            v-if="ifSelected == false"
            :value="competitions"
            v-model:selection="selectedDiscipline"
            selectionMode="single"
            dataKey="id"
            responsiveLayout="scroll"
            scrollable
            scrollHeight="400px"
            class="datatable m-20-auto"
        >
            <template #header>Competitions </template>
            <Column
                v-for="column in disciplineColumns"
                :key="column.field"
                :field="column.field"
                :header="column.header"
            ></Column>
        </DataTable>
        <Button
            v-if="ifSelected == false"
            @click="handleClick"
            label="Add Competitors"
            class="p-button-rounded m-3"
        />
        <Button
            v-if="ifSelected"
            @click="backToDisciplines"
            label="Choose discipline"
            class="p-button-rounded m-5"
        />
        <DataTable
            v-if="
                ifSelected &&
                competitionOccupied == false &&
                filteredCompetitors.length > 0
            "
            :value="filteredCompetitors"
            v-model:selection="selectedCompetitors"
            selectionMode="multiple"
            dataKey="id"
            :metaKeySelection="false"
            responsiveLayout="scroll"
            :scrollable="true"
            scrollHeight="400px"
            class="datatable w-30rem m-2"
        >
            <template #header>Competitors </template>
            <Column
                v-for="column in competitorColumns"
                :key="column.field"
                :field="column.field"
                :header="column.header"
            ></Column>
        </DataTable>
        <h1 v-if="ifSelected && competitionOccupied == true">
            This competition is occupied, choose another one.
        </h1>
        <h1 v-if="ifSelected && filteredCompetitors.length == 0">
            There's no sportsman that matches this competition
        </h1>
        <Button
            v-if="
                ifSelected &&
                competitionOccupied == false &&
                filteredCompetitors.length > 0
            "
            @click="save"
            label="Save"
            class="p-button-rounded m-3"
        />
    </div>
</template>
<script setup>
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";
import { useCompetitions } from "utils/composables/useCompetitions";
import { useCompetitors } from "utils/composables/useCompetitors";
import { disciplineColumns } from "utils/consts/disciplineColumns.js";
import { competitorColumns } from "utils/consts/competitorColumns.js";

const { getCompetitionsByUserId, competitions } = useCompetitions();
const { getCompetitorsByUserId, competitors } = useCompetitors();
const router = useRouter();
const ifSelected = ref(false);
const competitionOccupied = ref(false);
const selectedDiscipline = ref();
const disciplineWithCompetitors = ref({});
const filteredCompetitors = ref([]);
const selectedCompetitors = ref();

onMounted(async () => {
    getCompetitionsByUserId();
    getCompetitorsByUserId();
});
const backToDisciplines = () => {
    ifSelected.value = false;
    competitionOccupied.value = false;
};
const handleClick = async () => {
    await getDisciplineWithSportsman();
    getMatchingCompetitors();
};
const getDisciplineWithSportsman = async () => {
    const response = await axios.get(
        `/api/getDisciplinesWithSportsman/${selectedDiscipline.value.id}`
    );
    disciplineWithCompetitors.value = response.data;
};
const getMatchingCompetitors = async () => {
    filteredCompetitors.value = [];
    if (
        disciplineWithCompetitors.value.sportsman.length > 0 &&
        disciplineWithCompetitors.value.participants <=
            disciplineWithCompetitors.value.sportsman.length
    ) {
        competitionOccupied.value = true;
    }
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
    ifSelected.value = true;
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
