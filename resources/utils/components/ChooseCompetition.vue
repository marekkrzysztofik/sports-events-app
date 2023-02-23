<template>
    <Navbar></Navbar>
    <div class="flex flex-column">
        <h1>Sign competitor to competition</h1>
        <div class="flex justify-content-around bg-dark-blue br-radius-15">
            <div class="w-5">
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
                    scrollHeight="400px"
                    class="m-3"
                >
                    <template #header>Competitors </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="surname" header="Surname"></Column>
                    <Column field="age" header="Age"></Column>
                    <Column field="sex" header="Sex"></Column>
                </DataTable>
            </div>
            <div class="w-8">
                <Dropdown
                    :options="ComptitionIds"
                    inputClass="string"
                    placeholder="Select competition"
                    v-model="participationForm.discipline_id"
                    class="m-3"
                />
                <Button
                    @click="saveParticipation"
                    label="Save"
                    class="p-button-rounded m-3"
                />
                <DataTable
                    :value="competitions"
                    responsiveLayout="scroll"
                    :scrollable="true"
                    scrollHeight="400px"
                    class="m-3"
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
} from "../consts/getOrDelete.js";
import { participationForm } from "../consts/form.js";
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const disciplineWithCompetitors = ref({});

const router = useRouter();
onMounted(async () => {
    getCompetitions();
});
onMounted(async () => {
    getCompetitors();
});
const ComptitionIds = [];
const ComptitorsIds = [];
for (let i = 0; i < competitions.value.length; i++) {
    ComptitionIds.push(competitions.value[i].id);
}
for (let i = 0; i < competitors.value.length; i++) {
    ComptitorsIds.push(competitors.value[i].id);
}
const saveParticipation = async () => {
    let stopFunction = false;
    const response = await axios.get(
        `/api/discWithSportsman/${participationForm.value.discipline_id}`
    );
    disciplineWithCompetitors.value = response.data;
    const competitorSex =
        competitors.value[
            ComptitorsIds.indexOf(participationForm.value.sportsman_id)
        ].sex;
    const competitorAge =
        competitors.value[
            ComptitorsIds.indexOf(participationForm.value.sportsman_id)
        ].age;
    const sex =
        competitions.value[
            ComptitionIds.indexOf(participationForm.value.discipline_id)
        ].sex;
    const minAge = competitions.value[
        ComptitionIds.indexOf(participationForm.value.discipline_id)
    ].ageGroup.substr(0, 2);
    const maxAge = competitions.value[
        ComptitionIds.indexOf(participationForm.value.discipline_id)
    ].ageGroup.substr(3, 2);
    if (competitorSex != sex) {
        console.error(
            "Cannot assign competitor to competition because of wrong sex"
        );
        stopFunction = true;
        return;
    }
    if (competitorAge < minAge || competitorAge > maxAge) {
        console.error(
            "Competitor is either too young or too old for this competition"
        );
        stopFunction = true;
        return;
    }
    if (
        disciplineWithCompetitors.value.sportsman.length >=
        disciplineWithCompetitors.value.participants
    ) {
        console.error("This competition is full");
        stopFunction = true;
    }
    disciplineWithCompetitors.value.sportsman.forEach((sportsman) => {
        if (sportsman.id == participationForm.value.sportsman_id) {
            console.error(
                "Competitor with this id is already assigned to this competition"
            );
            stopFunction = true;
            return;
        }
    });
    if (stopFunction) {
        return;
    }
    await axios
        .post("/api/assignSportsman", { ...participationForm.value })
        .then(() => {
            Object.keys(participationForm.value).forEach(
                (key) => (participationForm.value[key] = "")
            );
            router.push("/admin/");
        });
};
</script>
