<template>
    <Navbar></Navbar>
    <div class="center">
        <div>
            <h1>Welcome to HomePage</h1>
            <p>Create your sports competition with this app</p>
        </div>
        <form @submit.prevent="submit">
            <label>
                Name:
                <input type="number" name="name" />
            </label>
            <Dropdown
                name="siema"
                v-model="siema"
                :options="arr"
                inputClass="string"
                placeholder="Select type of account"
                class="m-3"
            />
            <label>
                Email:
                <input type="email" name="email" />
            </label>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>
<script setup>
import { ref } from "vue";
const submit = (event) => {
    const { name, email, siema } = Object.fromEntries(
        new FormData(event.target)
    );
    const form = { name, email, siema };
    console.log(form);
};
const siema = ref();
const arr = ["marek", "ziomal"];
</script>
