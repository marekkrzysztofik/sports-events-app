<template>
    <h1>Create Competition</h1>
    <Navbar></Navbar>
    <div
        class="flex flex-column bg-dark-blue w-10 m-20-auto br-radius-15 pad-15"
    >
        <h2>Add new competition</h2>
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
                    <p>
                        <InputText
                            v-model="form.participants"
                            type="number"
                            placeholder="Number of participants"
                        />
                    </p>
                </div>
                <div>
                    <p class="text-danger" v-for="error in errors" :key="error">
                        <span v-for="err in error" :key="err">{{ err }} </span>
                    </p>
                </div>
                <p>
                    <Checkbox v-model="form.timeNotScore" :binary="true" />
                    Check for time, leave for score
                </p>

                <p>
                    <Checkbox v-model="form.bigScoreWins" :binary="true" />
                    Check if the biggest score wins
                </p>
                <p>
                    <Button
                        @click="saveCompetition"
                        label="Save"
                        class="p-button-rounded"
                    />
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import {
    disciplines1,
    sports,
    ageCategories,
    sex,
} from "./consts/disciplines.js";
import { form, compStyle, date } from "./consts/form.js";
import { useRouter } from "vue-router";
const router = useRouter();
const errors = ref([]);
const saveCompetition = async () => {
    form.value.startTime = date.value.day + " " + date.value.time;
    form.value.style = compStyle.value.style.cname;
    form.value.competition = compStyle.value.competition.cname;
    await axios
        .post("/api/createDiscipline", { ...form.value })
        .then(() => {
            Object.keys(form.value).forEach((key) => (form.value[key] = ""));
            router.push("/admin/");
        })
        .catch(() => {
            console.log("error");
        });
    console.log(form.value.style);
};
</script>
<style scoped>
.input-grid {
    margin: auto;
    display: grid;
    align-items: center;
    grid-template-columns: repeat(5, 250px);
    grid-template-rows: repeat(2, 1fr);
    grid-column-gap: 0px;
    grid-row-gap: 0px;
}
</style>
