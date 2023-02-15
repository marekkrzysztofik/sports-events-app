<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <div class="justify-content-around flex align-items-center">
        <div class="flex">
            <img class="logo" src="" alt="LOGO" />
            <h1 class="logo-name">SportsEvents</h1>
        </div>
        <div class="flex">
            <ul class="no-list-style flex">
                <li class="m-3">
                    <router-link to="/admin/create" class="no-decoration"
                        ><Button label="Create competition"
                    /></router-link>
                </li>
                <li class="m-3">
                    <Button label="Register" />
                </li>
                <li class="m-3">
                    <Button @click="logout" label="Log Out" />
                </li>
            </ul>
            <img class="cart" src="" alt="icon" />
            <img class="user" src="" alt="icon" />
        </div>
    </div>
    <div class="w-8 flex m-auto">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
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
const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
};
const getCompetitions = async () => {
    const response = await axios.get("/api/getDisc");
    competitions.value = response.data;
    console.log(competitions.value[0]);
};
</script>
