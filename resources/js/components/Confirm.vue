<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <DataTable v-if="$route.name === 'AdminHome'" :value="competitions">
        <template #header>Actions </template>
        <Column field="startTime" header="Edit/Delete/Browse">
            <template #body="event">
                <div class="actions-height assign-width">
                    <button
                        v-if="userType == 'admin'"
                        @click="onEdit(event.data.id)"
                        class="btn-icon btn-icon-success"
                    >
                        <i class="pi pi-pencil"></i>
                    </button>
                    <button
                        v-if="userType == 'admin'"
                        @click="confirm2(event.data.id)"
                        class="btn-icon btn-icon-danger"
                    >
                        <i class="pi pi-ban"></i>
                    </button>
                    <button
                        @click="viewCompetitors(event.data.id)"
                        class="btn-icon btn-icon-users"
                    >
                        <i class="pi pi-users"></i>
                    </button>
                </div>
            </template>
        </Column>
    </DataTable>
    <DataTable v-if="$route.name === 'Competitors'" :value="competitors">
        <template #header>Actions </template>
        <Column v-if="userType == 'admin'" header="Edit/Delete">
            <template #body="event1">
                <div class="actions-height">
                    <button
                        @click="onEdit(event1.data.id)"
                        class="btn-icon btn-icon-success"
                    >
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
        <Column
            header="Set scores"
            v-if="userType == 'admin' || userType == 'referee'"
        >
            <template #body="assign">
                <div class="actions-height assign-width">
                    <button
                        class="btn-icon btn-icon-add"
                        @click="setScore(assign.data.id)"
                    >
                        <i class="pi pi-plus"></i>
                    </button>
                </div>
            </template>
        </Column>
    </DataTable>
    <DataTable v-if="$route.name === 'Participations'" :value="participations">
        <template #header>Actions </template>
        <Column v-if="userType == 'admin'" header="Delete">
            <template #body="event2">
                <div class="actions-height assign-width">
                    <button
                        @click="confirm2(event2.data.id)"
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
import { onMounted } from "vue";
import { userType } from "/resources/modules/Organizer/composables/user.js";
import { useRoute, useRouter } from "vue-router";
import {
    getCompetitions,
    competitions,
    deleteDisc,
    competitors,
    getCompetitors,
    deleteCompetitor,
    getParticipations,
    participations,
    deleteParticipation,
} from "/resources/utils/consts/getOrDelete.js";
const router = useRouter();
const route = useRoute().path;
const routeName = useRoute().name;
console.log(routeName);
onMounted(async () => {
    getCompetitions();
    getCompetitors();
    getParticipations();
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
            if (route == "/admin") {
                deleteDisc(id);
            }
            if (route == "/admin/competitors") {
                deleteCompetitor(id);
            }
            if (routeName == "Participations") {
                deleteParticipation(id);
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
const onEdit = (id) => {
    if (route == "/admin") {
        router.push(`/admin/edit-discipline/${id}`);
    }
    if (route == "/admin/competitors") {
        router.push(`/admin/edit-competitor/${id}`);
    }
};
const viewCompetitors = (id) => {
    router.push(`/admin/participations/${id}`);
};
const setScore = (id) => {
    router.push(`/admin/scores/${id}`);
};
</script>
<style scoped>
.actions-height {
    height: 24px;
}
.assign-width {
    width: 120px;
}
</style>
