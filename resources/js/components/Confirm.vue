<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <DataTable v-if="$route.name === 'AdminHome'" :value="competitions">
        <template #header>Actions </template>
        <Column field="startTime" header="Edit/Delete record">
            <template #body="event">
                <div class="height-competitions">
                    <button class="btn-icon btn-icon-success">
                        <i class="pi pi-pencil"></i>
                    </button>
                    <button
                        @click="confirm2(event.data.id)"
                        class="btn-icon btn-icon-danger"
                    >
                        <i class="pi pi-ban"></i>
                    </button>
                </div>
            </template>
        </Column>
    </DataTable>
    <DataTable v-if="$route.name === 'Competitors'" :value="competitors">
        <template #header>Actions </template>
        <Column field="startTime" header="Edit/Delete record">
            <template #body="event1">
                <div class="height-competitors">
                    <button class="btn-icon btn-icon-success">
                        <i class="pi pi-pencil"></i>
                    </button>
                    <button
                        @click="confirm2(event1.data.id)"
                        class="btn-icon btn-icon-danger"
                    >
                        <i class="pi pi-ban"></i>
                    </button>
                </div>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import { onMounted, watch, computed } from "vue";
import { useRoute } from "vue-router";
import {
    getCompetitions,
    competitions,
    deleteDisc,
    competitors,
    getCompetitors,
    deleteCompetitor,
} from "/resources/utils/consts/getOrDelete.js";

const route = useRoute().path;

onMounted(async () => {
    getCompetitions();
});
onMounted(async () => {
    getCompetitors();
});
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

            if (route == "/admin/") {
                deleteDisc(id);
            }
            if (route == "/admin/competitors") {
                deleteCompetitor(id);
            }
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
<style scoped>
.height-competitions {
    height: 43px;
}
.height-competitors {
    height: 21.5px;
}
</style>
