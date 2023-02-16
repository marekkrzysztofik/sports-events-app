<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <Navbar></Navbar>
    <div class="w-10 flex m-auto">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="style" header="Style"></Column>
            <Column field="competition" header="Competition"></Column>
            <Column field="ageGroup" header="Age Group"></Column>
            <Column field="startTime" header="Start Time"></Column>
            <Column field="sex" header="Sex"></Column>
            <Column field="participants" header="Participants"></Column>
            <Column field="timeNotScore" header="timeNotScore"></Column>
            <Column field="bigScoreWins" header="bigScoreWins"></Column>
            <Column header="Actions">
                <template #body="event">
                    <button class="btn-icon btn-icon-success">
                        <i class="pi pi-pencil"></i>
                    </button>
                    <button
                        @click="confirm2(event.data.id)"
                        class="btn-icon btn-icon-danger"
                    >
                        <i class="pi pi-ban"></i>
                    </button>
                </template>
            </Column>
            <template #footer>
                In total there are
                {{ competitions ? competitions.length : 0 }} competitions.
            </template>
        </DataTable>
    </div>
</template>
<script setup>
import { useRouter } from "vue-router";
import { onMounted, ref } from "vue";
import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";
import ConfirmDialog from "primevue/confirmdialog";

const toast = useToast();
const confirm = useConfirm();
const confirm2 = (id) => {
    confirm.require({
        message: "Do you want to delete this record?",
        header: "Delete Confirmation",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
            toast.add({
                severity: "info",
                summary: "Confirmed",
                detail: "Record deleted",
                life: 3000,
            });
            deleteDisc(id);
        },
        reject: () => {
            toast.add({
                severity: "error",
                summary: "Rejected",
                detail: "You have rejected",
                life: 3000,
            });
        },
    });
};
const deleteDisc = (disc) => {
    axios.get(`/api/deleteDisc/${disc}`).then(() => {
        getCompetitions();
    });
};
const router = useRouter();
onMounted(async () => {
    getCompetitions();
});
const competitions = ref([]);
const getCompetitions = async () => {
    const response = await axios.get("/api/getDisc");
    competitions.value = response.data;
};
</script>
