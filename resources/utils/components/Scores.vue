<template>
    <Navbar></Navbar>
    <div class="flex">
        <ul class="no-list-style flex">
            <li class="m-3">
                <h1 class="m-0">{{ sportsmanWithDisc.name }}</h1>
            </li>
            <li class="m-3">
                <h1 class="m-0">{{ sportsmanWithDisc.surname }}</h1>
            </li>
            <li class="m-3">
                Age:
                {{ sportsmanWithDisc.age }}
            </li>
            <li class="m-3">
                Sex:
                {{ sportsmanWithDisc.sex }}
            </li>
        </ul>
    </div>
    <div class="flex">
        <DataTable
            :value="sportsmanWithDisc.disciplines"
            responsiveLayout="scroll"
            class="w-6"
        >
            <template #header>Disciplines </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
            <Column field="style" header="Surname"></Column>
            <Column field="competition" header="Age"></Column>
            <Column header="Time">
                <template #body>
                    <div class="actions-height assign-width">
                        <InputText
                            type="time"
                            placeholder="Time"
                            step="2"
                            class="m-3"
                        />
                    </div>
                </template>
            </Column>
        </DataTable>
        <div class="save-button m-3">
            <Button label="Save" class="p-button-rounded" />
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";

onMounted(async () => {
    getSportsmanWithDisc();
});

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const sportsmanWithDisc = ref({});
const getSportsmanWithDisc = async () => {
    const response = await axios.get(`/api/sportsmanWithDisc/${props.id}`);
    sportsmanWithDisc.value = response.data;
    console.log(sportsmanWithDisc.value);
};

const saveScore = async () => {
    console.log(participationForm.value)
    
    // await axios
    //     .post(`/api/createOrUpdateParticipation`, { ...participationForm.value }) 
    //     .then(() => {
    //         Object.keys(participationForm.value).forEach((key) => (participationForm.value[key] = ""));
    //         router.push("/admin/");
    //     });
};
</script>
