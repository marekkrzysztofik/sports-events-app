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
                    <Checkbox v-model="form.timeNotScore" :binary="true" />
                    <p>Check for time, leave for score</p>
                </div>
                <div class="m-3">
                    <Checkbox v-model="form.bigScoreWins" :binary="true" />
                    <p>Check if the biggest score wins</p>
                </div>
                <div class="save-button m-3">
                    <Button
                        @click="saveCompetition"
                        label="Save"
                        class="p-button-rounded"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import {
    disciplines1,
    sports,
    ageCategories,
    sex,
} from "./consts/disciplines.js";
import { form, compStyle, date, id } from "./consts/form.js";
import { useRouter } from "vue-router";
const router = useRouter();

onMounted(async () => {
    getSingleDiscipline();
});
const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});
const getSingleDiscipline = async () => {
    const response = await axios.get(`/api/editDisc/${props.id}`); 
    console.log(response.data);
    id.value = response.data.id;
    form.value = response.data; 
};
const saveCompetition = async () => {
    form.value.startTime = date.value.day + " " + date.value.time;
    form.value.style = compStyle.value.style.cname;
    form.value.competition = compStyle.value.competition.cname;
    await axios
        .post(`/api/createOrUpdateDiscipline`, { ...form.value }) 
        .then(() => {
            Object.keys(form.value).forEach((key) => (form.value[key] = ""));
            router.push("/admin/");
        });
};
</script>

