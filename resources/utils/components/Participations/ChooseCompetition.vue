<template>
    <Navbar />
    <div class="flex flex-column center">
        <h2>Sign competitor to competition</h2>
        <div
            class="flex w-9 m-auto justify-content-around bg-dark-blue br-radius-15"
        >
            <div class="m-3">
                <DataTable
                    :value="competitions"
                    v-model:selection="choosingForm.discipline"
                    selectionMode="single"
                    dataKey="id"
                    responsiveLayout="scroll"
                    :scrollable="true"
                    scrollHeight="400px"
                    class="pad-30-0"
                >
                    <template #header>Competitions </template>
                    <Column field="id" header="ID"></Column>
                    <Column field="name" header="Name"></Column>
                    <Column field="style" header="Style"></Column>
                    <Column field="competition" header="Competition"></Column>
                    <Column field="minAge" header="MinAge"></Column>
            <Column field="maxAge" header="MaxAge"></Column>
                    <Column field="startTime" header="Start Time"></Column>
                    <Column field="sex" header="Sex"></Column>
                </DataTable>
            </div>
        </div>
        <Button @click="save" label="Save" class="p-button-rounded m-3" />
        <div class="m-3">
            <DataTable
                :value="competitors"
                v-model:selection="choosingForm.sportsman"
                selectionMode="multiple"
                dataKey="id"
                :metaKeySelection="false"
                responsiveLayout="scroll"
                :scrollable="true"
                scrollHeight="400px"
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
    </div>
</template>
<script setup>
import { 
    getDisciplinesByUserId,
    competitions,
    competitors,
    getCompetitorsByUserId,
} from "../../consts/getOrDelete.js";
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";
const router = useRouter();
onMounted(async () => {
    getDisciplinesByUserId();
    getCompetitorsByUserId();
});
const choosingForm = ref({
    discipline:[],
    sportsman:[]
})
const disciplineMinAge = ref()
const disciplineMaxAge = ref()
const disciplineSex = ref()

const save = async () => {
    disciplineMinAge.value = choosingForm.value.discipline.ageGroup.substr(0, 2);
    disciplineMaxAge.value = choosingForm.value.discipline.ageGroup.substr(3, 2);
    disciplineSex.value = choosingForm.value.discipline.sex
    
    // await saveParticipation();
    // if (success.value == 1) {
    //     router.push("/admin");
    // }
    // success.value = 0;
};
</script>
