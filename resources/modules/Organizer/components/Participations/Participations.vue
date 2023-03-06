<template>
    <Navbar></Navbar>
    <ConfirmDialog />
    <div class="flex">
        <ul class="no-list-style flex">
            <li class="m-3">
                <h1 class="m-0">{{ discipline.name }}</h1>
            </li>
            <li class="m-3">Style: {{ discipline.style }}</li>
            <li class="m-3">
                Competition:
                {{ discipline.competition }}
            </li>
            <li class="m-3">
                Age Group:
                {{ discipline.ageGroup }}
            </li>
            <li class="m-3">
                Start Time:
                {{ discipline.startTime }}
            </li>
            <li class="m-3">Sex: {{ discipline.sex }}</li>
            <li class="m-3">
                Participants:
                {{ discipline.participants }}
            </li>
            <li class="m-3">
                Time Not Score:
                {{ discipline.timeNotScore }}
            </li>
            <li class="m-3">
                Big Score Wins:
                {{ discipline.bigScoreWins }}
            </li>
        </ul>
    </div>
    <div class="flex justify-content-center">
        <DataTable
            :value="participationsWithCompetitors"
            editMode="row"
            dataKey="id"
            v-model:editingRows="editingRows"
            @row-edit-save="onRowEditSave"
            responsiveLayout="scroll"
        >
            <template #header>Competitors </template>
            <Column field="id" header="ParticipationID"></Column>
            <Column field="sportsman_id" header="SportsmanID"></Column>
            <Column field="surname" header="Surname"></Column>
            <Column field="age" header="Age"></Column>
            <Column field="sex" header="Sex"></Column>
            <Column v-if="user.type == 'admin'" header="Edit/Delete">
                <template #body="event1">
                    <button
                        @click="confirmDialog(event1.data.id)"
                        class="btn-icon btn-icon-danger"
                    >
                        <i class="pi pi-ban"></i>
                    </button>
                </template>
            </Column>
            <Column v-if="discipline.timeNotScore == 0" field="score" header="Score" style="width: 2rem"
                ><template #editor="{ data, field }">
                    <InputText v-model="data[field]" /> </template
            ></Column>
            <Column v-if="discipline.timeNotScore == 1" field="time" header="Time" style="width: 2rem"
                ><template #editor="{ data, field }">
                    <InputText v-model="data[field]" /> </template
            ></Column>
            <Column
                :rowEditor="true"
                style="width: 8rem"
                bodyStyle="text-align:center"
            ></Column>
            <template #footer>
                In total there are
                {{
                    participationsWithCompetitors
                        ? participationsWithCompetitors.length
                        : 0
                }}
                competitors.
            </template>
        </DataTable>
        <Button @click="save" label="Save" class="p-button-rounded m-3" />
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import { useConfirm } from "primevue/useconfirm";
import { useRouter } from "vue-router";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import { user } from "../../composables/user.js";
onMounted(async () => {
    getParticipationWithCompetitors();
    getDiscipline();
});

const editingRows = ref([]);

const onRowEditSave = (event) => {
    let { newData, index } = event;
    participationsWithCompetitors.value[index] = newData;
};
const save = async () => {
    const scoreTable = participationsWithCompetitors.value.map((item) => {
        return {
            id: item.id,
            discipline_id: item.discipline_id,
            sportsman_id: item.sportsman_id,
            time: item.time,
            score: item.score,
        };
    });
    await axios
        .post("/api/createOrUpdateParticipation", {
            ...scoreTable,
        })
        .then(() => {
            router.push("/admin");
        });
    console.log(scoreTable);
};
const router = useRouter();
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const deleteParticipation = (id) => {
    axios.get(`/api/deleteParticipation/${id}`).then(() => {
        getParticipationWithCompetitors();
    });
};
const participationsWithCompetitors = ref([]);
const getParticipationWithCompetitors = async () => {
    const response = await axios.get(
        `/api/participationJoinedWithCompetitors/${props.id}`
    );
    participationsWithCompetitors.value = response.data;
};
const discipline = ref("");
const getDiscipline = async () => {
    const response = await axios.get(`/api/getDisciplineById/${props.id}`);
    discipline.value = response.data;
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
            deleteParticipation(id);
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
