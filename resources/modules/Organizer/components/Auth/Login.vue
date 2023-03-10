<template>
    <div class="container">
        <Navbar></Navbar>
        <div class="center">
            <h1>Log in to continue</h1>
            <h2>Log in</h2>
            <Dropdown
                v-if="userTypeChosen == false"
                v-model="loginForm.type"
                :options="types"
                inputClass="string"
                placeholder="Select type of account"
                class="m-3"
            />
            <Button
                v-if="userTypeChosen == false"
                label="Select"
                @click="select"
                class="p-button-rounded m-4"
            />
            <p>
                <InputText
                    v-if="userTypeChosen == true"
                    type="text"
                    placeholder="Enter your email"
                    v-model="loginForm.email"
                />
            </p>
            <p>
                <InputText
                    v-if="userTypeChosen == true"
                    type="password"
                    placeholder="Enter your password"
                    v-model="loginForm.password"
                />
            </p>
            <Button
                v-if="userTypeChosen == true"
                label="Login"
                @click="login()"
                class="p-button-rounded m-2"
            />
            <div class="flex">
                <p class="error-msg m-4" v-if="error" :key="error">
                    {{ error }}
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { user } from "/resources/modules/Organizer/components/Auth/user.js";
const userTypeChosen = ref(false);
const select = () => {
    userTypeChosen.value = true;
};
const types = ["Admin", "Coach/Referee"];
const router = useRouter();
const loginForm = reactive({
    email: "",
    password: "",
    type: "",
});
const error = ref();
const login = async () => {
    await axios
        .post("/api/handleLogin", loginForm)
        .then((response) => {
            const loginResponse = response.data;
            if (loginResponse.success) {
                localStorage.setItem("token", loginResponse.data.token);
                user.value.id = loginResponse.data.id;
                user.value.type = loginResponse.data.type;
                router.push("/Admin/");
            }
        })
        .catch((e) => {
            error.value = e.response.data.message;
        });
};
</script>
