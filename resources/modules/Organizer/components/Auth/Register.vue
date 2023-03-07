<template>
    <div class="container">
        <Navbar></Navbar>
        <div class="center">
            <h1>Create your account</h1>
            <h2>Register</h2>
            <div class="flex flex-column">
                <InputText
                    class="m-2"
                    type="text"
                    placeholder="Enter your name"
                    v-model="form.name"
                />
                <InputText
                    class="m-2"
                    type="text"
                    placeholder="Enter your email"
                    v-model="form.email"
                />
                <InputText
                    class="m-2"
                    type="password"
                    placeholder="Enter your password"
                    v-model="form.password"
                />
                <InputText
                    class="m-2"
                    type="password"
                    placeholder="Confirm your password"
                    v-model="form.c_password"
                />
                <Dropdown
                    v-model="form.type"
                    :options="types"
                    inputClass="string"
                    placeholder="Select type of account"
                    class="m-3"
                />
                <Dropdown
                    v-model="form.type"
                    :options="types"
                    inputClass="string"
                    placeholder="Select type of account"
                    class="m-3"
                />
                <Button
                    label="Register"
                    @click="register()"
                    class="p-button-rounded m-4"
                />
                <p class="" v-for="error in errors" :key="error">
                    <span v-for="err in error" :key="err">{{ err }} </span>
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const types = ["admin", "coach", "referee"]; 
const form = reactive({
    name: "",
    type: "",
    user_id:'',
    email: "",
    password: "",
    c_password: "",
});
const errors = ref([]);
const register = async () => {
    await axios
        .post("/api/register", form)
        .then((response) => {
            if (response.data.success) {
                localStorage.setItem("token", response.data.data.token);
                router.push("/login");
            }
        })
        .catch((e) => {
            errors.value = e.response.data.message;
        });
};
</script>
