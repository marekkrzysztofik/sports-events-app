<template>
    <Navbar></Navbar>
    <div class="flex flex-column bg-dark-blue w-7 m-20-auto br-radius-15">
        <div class="m-auto">
            <h2 class="center">Edit competitior</h2>
            <div class="input-grid">
                <div>
                    <InputText
                        v-model="competitorForm.name"
                        type="text"
                        placeholder="Name of competitor"
                        class="m-3"
                    />
                    <InputText
                        v-model="competitorForm.surname"
                        type="text"
                        placeholder="Surname of competitor"
                        class="m-3"
                    />
                </div>
                <div>
                    <Dropdown
                        v-model="competitorForm.sex"
                        :options="sex"
                        inputClass="string"
                        placeholder="Select sex"
                        class="m-3"
                    />
                    <InputText
                        v-model="competitorForm.age"
                        type="number"
                        placeholder="Age"
                        class="m-3"
                    />
                </div>
                <div>
                    <p class="text-danger" v-for="error in errors" :key="error">
                        <span v-for="err in error" :key="err">{{ err }} </span>
                    </p>
                </div>
                <p>
                    <Button
                        @click="saveCompetitor"
                        label="Save"
                        class="p-button-rounded m-3"
                    />
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { sex } from "utils/consts/disciplines.js";
import { useSaveCompetitor } from "utils/composables/useSaveCompetitor";
const { competitorForm, saveCompetitor } = useSaveCompetitor();
onMounted(async () => {
    getSingleSportsman();
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const getSingleSportsman = async () => {
    const response = await axios.get(`/api/getSportsmanById/${props.id}`);
    competitorForm.value = response.data;
};
</script>
<style scoped>
.input-grid {
    margin: auto;
    display: grid;
    align-items: center;
    grid-template-columns: repeat(2, 250px);
    grid-template-rows: repeat(2, 1fr);
    grid-column-gap: 0px;
    grid-row-gap: 0px;
}
</style>
