<template>
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
                        v-model="ageGroup"
                        :options="ageCategories"
                        inputClass="string"
                        placeholder="Select age category"
                        class="m-3"
                    />
                </div>
                <div>
                    <CascadeSelect
                        v-model="compStyle.style"
                        :options="disciplines"
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
                        :options="disciplines"
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
                        v-model="form.timeNotScore"
                        :binary="true"
                        :trueValue="1"
                        :falseValue="0"
                    />
                    <p class="bright-txt">Check for time, leave for score</p>
                </div>
                <div class="m-3">
                    <Checkbox
                        v-model="form.bigScoreWins"
                        :binary="true"
                        :trueValue="1"
                        :falseValue="0"
                    />
                    <p class="bright-txt">Check if the biggest score wins</p>
                </div>
                <div class="save-button m-3">
                    <Button
                        @click="saveCompetition"
                        label="Save"
                        class="save-btn"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import {
    disciplines,
    sports,
    ageCategories,
    sex,
} from "utils/consts/disciplines.js";
import { useSaveDiscipline } from "utils/composables/useSaveDiscipline.js";

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const { date, compStyle, form, ageGroup, saveCompetition } =
    useSaveDiscipline();

onMounted(async () => {
    getSingleDiscipline();
});
const getSingleDiscipline = async () => {
    const response = await axios.get(`/api/getDisciplineById/${props.id}`);
    form.value = response.data;
};
</script>
<style scoped>
.save-button {
    grid-area: 2/4/2/4;
}
</style>
