<template>
    <Navbar></Navbar>
    <div class="flex flex-column bg-dark-blue w-7 m-20-auto br-radius-15">
        <div class="m-auto">
            <h2 class="center">Add new competitior</h2>
            <div class="input-grid">
                <div>
                    <InputText
                        v-model="compForm.name"
                        type="text"
                        placeholder="Name of competitor"
                        class="m-3"
                    />
                    <InputText
                        v-model="compForm.surname"
                        type="text"
                        placeholder="Surname of competitor"
                        class="m-3"
                    />
                </div>
                <div>
                    <Dropdown
                        v-model="compForm.sex"
                        :options="sex"
                        inputClass="string"
                        placeholder="Select sex"
                        class="m-3"
                    />
                    <InputText
                        v-model="compForm.age"
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
                        @click="save"
                        label="Save"
                        class="p-button-rounded m-3"
                    />
                </p>
            </div> 
        </div>
    </div>
</template>
<script setup>
import { compForm } from "../../consts/form.js";
import { success, saveCompetitor } from "../../composables/saveCompetitor.js";
import { sex } from "../../consts/disciplines.js";
import { useRouter } from "vue-router";
const router = useRouter();
const save = async () => {
    await saveCompetitor();
    console.log(success.value);
    if (success.value == 1) {
        router.push("/admin/competitors");
    }
    success.value = 0;
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
