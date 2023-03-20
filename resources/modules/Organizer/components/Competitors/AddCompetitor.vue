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
                <Button
                    @click="saveCompetitor"
                    label="Save"
                    class="p-button-rounded m-3 save-btn w-9"
                />
            </div>
        </div> 
    </div>
</template>
<script setup>
import { useSaveCompetitor } from "utils/composables/useSaveCompetitor";
import { sex } from "utils/consts/disciplines.js";
const { compForm, saveCompetitor } = useSaveCompetitor();
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
