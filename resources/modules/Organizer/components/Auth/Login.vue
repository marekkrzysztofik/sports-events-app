<template>
    <div class="container">
        <Navbar></Navbar>
        <div class="center">
            <h1>Log in to continue</h1>
            <h2>Log in</h2>
            <p>
                <InputText
                    class=""
                    type="text"
                    placeholder="Enter your email"
                    v-model="form.email"
                />
            </p>
            <p>
                <InputText
                    class=""
                    type="password"
                    placeholder="Enter your password"
                    v-model="form.password"
                />
            </p>
            <Button
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

const router = useRouter();
const form = reactive({
    email: "",
    password: "",
});
const errors = ref([]);
const login = async () => {
    await axios
        .post("/api/login", form)
        .then((response) => {
            if (response.data.success) {
                localStorage.setItem("token", response.data.data.token);
                router.push("/Admin/");
            }
        })
        .catch((e) => {
            errors.value = e.response.data.message;
        });
};
</script>
