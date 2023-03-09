<template> 
    <Navbar></Navbar>
    <ConfirmDialog />
    <div class="w-10 flex m-auto justify-content-center">
        <DataTable :value="competitors" responsiveLayout="scroll">
            <template #header>Competitors </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="surname" header="Surname"></Column>
            <Column field="age" header="Age"></Column>
            <Column field="sex" header="Sex"></Column>
            <Column v-if="user.type == 'admin'" header="Edit/Delete">
                <template #body="event1">
                    <div class="actions-height">
                        <button
                            @click="getCompetitor(event1.data.id)"
                            class="btn-icon btn-icon-success"
                        >
                            <i class="pi pi-pencil"></i>
                        </button>
                        <button
                            @click="confirmDialog(event1.data.id)"
                            class="btn-icon btn-icon-danger"
                        >
                            <i class="pi pi-ban"></i>
                        </button>
                    </div>
                </template>
            </Column>
            <template #footer>
                In total there are
                {{ count }} competitors.
            </template>
        </DataTable>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useConfirm } from "primevue/useconfirm";
import { useRouter } from "vue-router";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import { user } from "/resources/modules/Organizer/components/Auth/user.js";
import { useCompetitors } from "../../../../utils/composables/useCompetitors.js";
import { useComputed } from '../../../../utils/composables/useComputed.js';
const { getCompetitorsByUserId, competitors } = useCompetitors();
const { count } = useComputed(competitors); 
const router = useRouter();
onMounted(async () => {
    getCompetitorsByUserId();
});
const deleteCompetitor = (sportsman) => {
    axios.delete(`/api/deleteSportsman/${sportsman}`).then(() => {
        getCompetitorsByUserId();
    });
};
const getCompetitor = (id) => {
    router.push(`/admin/edit-competitor/${id}`);
};
const toast = useToast();
const confirm = useConfirm();
const confirmDialog = (id) => {
    confirm.require({
        message: "Do you want to delete this competitor?",
        header: "Delete Confirmation",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
            toast.add({
                severity: "info",
                summary: "Confirmed",
                detail: "Competitor deleted",
                life: 3000,
            });
            deleteCompetitor(id);
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
