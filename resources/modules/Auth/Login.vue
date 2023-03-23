<template>
    <div class="container">
        <div class="center">
            <h1>Log in to continue</h1>
            <h2>Log in</h2>
            <form @submit.prevent="submit">
                <div class="flex flex-column">
                    <Dropdown
                        v-if="!userTypeChosen"
                        v-model="loginForm.type"
                        :options="types"
                        inputClass="string"
                        placeholder="Select type of account"
                        class="m-3"
                    />
                    <InputText
                        v-if="userTypeChosen"
                        type="text"
                        placeholder="Enter your email"
                        v-model="loginForm.email"
                        name="email"
                        class="m-2"
                    />
                    <InputText
                        v-if="userTypeChosen"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        v-model="loginForm.password"
                        class="m-2"
                    />
                    <Button
                        v-if="!userTypeChosen"
                        label="Select"
                        @click="select"
                        class="p-button-rounded m-4"
                    />
                    <Button
                        v-if="userTypeChosen"
                        label="Login"
                        @click="login"
                        class="p-button-rounded m-4"
                    />
                </div>
            </form>
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
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

const userInfo = useUserInfo();
const userTypeChosen = ref(false);
const types = ["Admin", "Coach/Referee"];
const router = useRouter();
const loginForm = reactive({
    email: "",
    password: "",
    type: "",
});
const error = ref();

const select = () => {
    userTypeChosen.value = true;
};
const submit = (event) => {
    console.log(event);
    const { email, password } = Object.fromEntries(new FormData(event.target));
    const form = { type, email, password };
    console.log(form);
};
const login = async () => {
    await axios
        .post("/api/handleLogin", loginForm)
        .then((response) => {
            const loginResponse = response.data;
            if (loginResponse.success) {
                localStorage.setItem("token", loginResponse.data.token);
                userInfo.id = loginResponse.data.id;
                userInfo.type = loginResponse.data.type;
                router.push("/Admin/");
            }
        })
        .catch((e) => {
            error.value = e.response.data.message;
        });
};
</script>
