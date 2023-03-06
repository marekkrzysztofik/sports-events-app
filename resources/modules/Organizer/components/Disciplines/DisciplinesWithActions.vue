<template>
    <Navbar />
    <ConfirmDialog />
    <div class="w-11 flex justify-content-center m-3">
        <DataTable :value="competitions" responsiveLayout="scroll">
            <template #header>Competitions </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="style" header="Style"></Column>
            <Column field="competition" header="Competition"></Column>
            <Column field="minAge" header="MinAge"></Column>
            <Column field="maxAge" header="MaxAge"></Column>
            <Column field="startTime" header="Start Time"></Column>
            <Column field="sex" header="Sex"></Column>
            <Column field="participants" header="Participants"></Column>
            <Column field="startTime" header="IconMenu">
                <template #body="event">
                    <div class="actions-height assign-width">
                        <button
                            v-if="user.type == 'admin'"
                            @click="getDiscipline(event.data.id)"
                            class="btn-icon btn-icon-success"
                        >
                            <i class="pi pi-pencil"></i>
                        </button>
                        <button
                            v-if="user.type == 'admin'"
                            @click="confirmDialog(event.data.id)"
                            class="btn-icon btn-icon-danger"
                        >
                            <i class="pi pi-ban"></i>
                        </button>
                        <button
                            v-if="user.type == 'admin'"
                            @click="editCompetitors(event.data.id)"
                            class="btn-icon btn-icon-users"
                        >
                            <i class="pi pi-users"></i>
                        </button>
                        <button
                            @click="viewScores(event.data.id)"
                            class="btn-icon btn-icon-users"
                        >
                            <i class="pi pi-stopwatch"></i>
                        </button>
                    </div>
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
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import { useCompetitions } from "../../../../utils/composables/useCompetitions.js";
import { user } from "/resources/modules/Organizer/composables/user.js";
const { getCompetitionsByUserId , competitions } = useCompetitions();
const router = useRouter();
onMounted(async () => {
    getCompetitionsByUserId();
}); 
const getDiscipline = (id) => {
    router.push(`/admin/edit-discipline/${id}`);
};
const deleteCompetition = (id) => {
    axios.get(`/api/deleteDiscipline/${id}`).then(() => {
        getCompetitionsByUserId();
    });
};
const editCompetitors = (id) => {
    router.push(`/admin/participations/${id}`);
};
const viewScores = (id) => {
    router.push(`/admin/view-scores/${id}`);
};
const toast = useToast();
const confirm = useConfirm();
const confirmDialog = (id) => {
    confirm.require({
        message: "Do you want to delete this competition?",
        header: "Delete Confirmation",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
            toast.add({
                severity: "info",
                summary: "Confirmed",
                detail: "Competition deleted",
                life: 3000,
            });
            deleteCompetition(id);
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
</script>
