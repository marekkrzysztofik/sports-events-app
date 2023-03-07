<template>
    <div class="container">
        <Navbar></Navbar>
        <div class="center">
            <h1>Log in to continue</h1>
            <h2>Log in</h2>
            <Dropdown
                v-if="userTypeChosen == false"
                v-model="userType"
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
            <p class="" v-for="error in errors" :key="error">
                <span v-for="err in error" :key="err">{{ err }} </span>
            </p>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { user } from "/resources/modules/Organizer/composables/user.js";
const userTypeChosen = ref(false);
const userType = ref("");
const select = () => {
    userTypeChosen.value = true;
};
const types = ["admin", "coach", "referee"];
const router = useRouter();
const loginForm = reactive({
    email: "",
    password: "",
});
const errors = ref([]);
const login = async () => {
    if (userType.value == "admin") {
        await axios
            .post("/api/adminLogin", loginForm)
            .then((response) => {
                if (response.data.success) {
                    localStorage.setItem("token", response.data.data.token);

                    user.value.id = response.data.data.id;
                    user.value.type = response.data.data.type;
                    router.push("/Admin/");
                }
            })
            .catch((e) => {
                errors.value = e.response.data.message;
            });
    }
    if (userType.value == "coach" || userType == "referee") {
        await axios
            .post("/api/coachLogin", loginForm)
            .then((response) => {
                if (response.data.success) {
                    localStorage.setItem("token", response.data.data.token);
                    user.value.id = response.data.data.user_id;
                    user.value.type = response.data.data.type;
                    console.log(user.value.id);
                    router.push("/Admin/");
                }
            })
            .catch((e) => {
                errors.value = e.response.data.message;
            });
    }
};
</script>
