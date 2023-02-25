<template>
    <Navbar></Navbar>
    <h1 class="center">Create Competition</h1>
    <div
        class="flex flex-column bg-dark-blue w-10 m-20-auto br-radius-15 pad-15"
    >
        <h2 class="m-3">Add new competition</h2>
        <div class="m-auto flex align-items-center">
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
                    <InputText v-model="date.day" class="m-3" type="date" />
                    <InputText v-model="date.time" class="m-3" type="time" />
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
                    <Checkbox v-model="form.timeNotScore"/>
                    <p>Check for time, leave for score</p>
                </div>
                <div class="m-3">
                    <Checkbox v-model="form.bigScoreWins"/>
                    <p>Check if the biggest score wins</p>
                </div>
                <div class="save-button m-3">
                    <Button
                        @click="save"
                        label="Save"
                        class="p-button-rounded"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {
    disciplines1,
    sports,
    ageCategories,
    sex,
} from "./consts/disciplines.js";
import { form, compStyle, date } from "./consts/form.js";
import { success, saveCompetition } from "./composables/saveDiscipline.js";
import { useRouter } from "vue-router";
const router = useRouter();
const save = async () => {
    await saveCompetition();
    if (success.value == 1) {
        router.push("/admin");
    }
    success.value=0
};
</script>
