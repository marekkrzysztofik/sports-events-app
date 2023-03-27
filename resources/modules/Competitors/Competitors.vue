<template>
    <Navbar></Navbar>
    <ConfirmDialog />
        <DataTable :value="competitors" responsiveLayout="scroll" class="datatable w-max m-20-auto">
            <template #header>Competitors </template>
            <Column
                v-for="column in competitorColumns"
                :key="column.field"
                :field="column.field"
                :header="column.header"
            ></Column>
            <Column v-if="userInfo.type == 'Admin'" header="Edit/Delete">
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
    
</template> 
<script setup>
import { onMounted } from "vue";
import { useConfirm } from "primevue/useconfirm";
import { useRouter } from "vue-router";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import { useCompetitors } from "utils/composables/useCompetitors";
import { useComputed } from "utils/composables/useComputed";
import { competitorColumns } from "utils/consts/competitorColumns";
import { useUserInfo } from "@/storage/Pinia/userInfo";

const userInfo = useUserInfo()
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
