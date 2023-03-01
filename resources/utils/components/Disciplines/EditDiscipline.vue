<template>
    <Navbar></Navbar>
    <h1 class="center">Edit Competition</h1>
    <div
        class="flex flex-column bg-dark-blue w-10 m-20-auto br-radius-15 pad-15"
    >
        <div class="m-auto flex">
            <div class="input-grid">
                <div>
                    <Dropdown
                        v-model="form.name"
                        :options="sports"
                        inputClass="string"
                        placeholder="Select a sport"
                        class="m-3"
                    />
                    <Dropdown
                        v-model="form.ageGroup"
                        :options="ageCategories"
                        inputClass="string"
                        placeholder="Select age category"
                        class="m-3"
                    />
                </div>
                <div>
                    <CascadeSelect
                        v-model="compStyle.style"
                        :options="disciplines1"
                        optionLabel="cname"
                        optionGroupLabel="name"
                        :optionGroupChildren="['styles']"
                        style="minwidth: 14rem"
                        placeholder="Select a style"
                        class="m-3"
                    >
                        <template #option="slotProps">
                            <div class="country-item">
                                <span>{{
                                    slotProps.option.cname ||
                                    slotProps.option.name
                                }}</span>
                            </div>
                        </template>
                    </CascadeSelect>
                    <CascadeSelect
                        v-model="compStyle.competition"
                        :options="disciplines1"
                        optionLabel="cname"
                        optionGroupLabel="name"
                        :optionGroupChildren="['competitions']"
                        style="minwidth: 14rem"
                        placeholder="Select a competition"
                        class="m-3"
                    >
                        <template #option="slotProps">
                            <div class="country-item">
                                <span>{{
                                    slotProps.option.cname ||
                                    slotProps.option.name
                                }}</span>
                            </div>
                        </template>
                    </CascadeSelect>
                </div>
                <div>
                    <p>
                        <InputText v-model="date.day" type="date" />
                    </p>
                    <p>
                        <InputText v-model="date.time" type="time" />
                    </p>
                </div>
                <div>
                    <Dropdown
                        v-model="form.sex"
                        :options="sex"
                        inputClass="string"
                        placeholder="Select sex"
                        class="m-3"
                    />
                    <InputText
                        v-model="form.participants"
                        type="number"
                        placeholder="Number of participants"
                        class="m-3"
                    />
                </div>
                <div class="m-3">
                    <Checkbox
                        v-model="booleanToNum.timeNotScore"
                        :binary="true"
                    />
                    <p>Check for time, leave for score</p>
                </div>
                <div class="m-3">
                    <Checkbox
                        v-model="booleanToNum.bigScoreWins"
                        :binary="true"
                    />
                    <p>Check if the biggest score wins</p>
                </div>
                <div class="save-button m-3">
                    <Button
                        @click="booleanToNumber"
                        label="Save"
                        class="p-button-rounded"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import {
    disciplines1,
    sports,
    ageCategories,
    sex,
} from "../../consts/disciplines.js";
import { form, compStyle, date } from "../../consts/form.js";
import { success, saveCompetition } from "../../composables/saveDiscipline.js";
import { useRouter } from "vue-router";
import { ref } from "vue";
const router = useRouter();
onMounted(async () => {
    getSingleDiscipline();
});
const booleanToNum = ref({
    timeNotScore: "",
    bigScoreWins: "",
});
const booleanToNumber = () => {
    if (booleanToNum.value.timeNotScore == true) {
        form.value.timeNotScore = 1;
    }
    if (booleanToNum.value.timeNotScore == false) {
        form.value.timeNotScore = 0;
    }
    if (booleanToNum.value.bigScoreWins == true) {
        form.value.bigScoreWins = 1;
    }
    if (booleanToNum.value.bigScoreWins == false) {
        form.value.bigScoreWins = 0;
    }
    save();
};
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const getSingleDiscipline = async () => {
    const response = await axios.get(`/api/getDiscipline/${props.id}`);
    form.value = response.data;
};
const save = async () => {
    await saveCompetition();
    if (success.value == 1) {
        router.push("/admin");
    }
    success.value = 0;
};
</script>
