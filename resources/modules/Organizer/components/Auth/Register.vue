<template>
    <div class="container">
        <Navbar></Navbar>
        <div class="center">
            <h1>Create your account</h1>
            <h2>Register</h2>
            <div class="flex flex-column">
                <Dropdown
                    v-if="userTypeChosen == false"
                    v-model="form.type"
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
                <InputText
                    v-if="userTypeChosen == true"
                    v-model="form.name"
                    class="m-2"
                    type="text"
                    placeholder="Enter your name"
                />
                <InputText
                    v-if="userTypeChosen == true"
                    v-model="form.email"
                    class="m-2"
                    type="text"
                    placeholder="Enter your email"
                />
                <InputText
                    v-if="userTypeChosen == true"
                    v-model="form.password"
                    class="m-2"
                    type="password"
                    placeholder="Enter your password"
                />
                <InputText
                    v-if="userTypeChosen == true"
                    v-model="form.c_password"
                    class="m-2"
                    type="password"
                    placeholder="Confirm your password"
                />
                <Dropdown
                    v-if="
                        (form.type == 'Coach' && userTypeChosen == true) ||
                        (form.type == 'Referee' && userTypeChosen == true)
                    "
                    v-model="form.user_id"
                    :options="users"
                    optionLabel="name"
                    optionValue="id"
                    inputClass="number"
                    placeholder="Assign to organizator"
                    class="m-3"
                />
                <Button
                    v-if="userTypeChosen == true"
                    label="Register"
                    @click="handleRegister"
                    class="p-button-rounded m-4"
                />
                <p class="error-msg" v-for="error in errors" :key="error">
                    <span v-for="err in error" :key="err">{{ err }} </span>
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { user } from "/resources/modules/Organizer/components/Auth/user.js";
onMounted(() => {
    getUsers();
});
const userTypeChosen = ref(false);
const users = ref([]);
const getUsers = async () => {
    const response = await axios.get("/api/getUsers");
    users.value = response.data;
};
const router = useRouter();
const types = ["Admin", "Coach", "Referee"];
const form = reactive({
    name: "",
    type: "",
    user_id: "",
    email: "",
    password: "",
    c_password: "",
});
const select = () => {
    userTypeChosen.value = true;
};
const errors = ref([]);
const handleRegister = () => {
    if (
        (!form.user_id && form.type == "Coach") ||
        (!form.user_id && form.type == "Referee")
    ) {
        errors.value.push("Assignment to Organizer is required.");
    } else {
        register();
    }
};
const register = async () => {
    await axios
        .post("/api/register", form)
        .then((response) => {
            const registerResponse = response.data;
            if (registerResponse.success) {
                localStorage.setItem("token", registerResponse.data.token);
                user.value.id = registerResponse.data.id;
                user.value.type = registerResponse.data.type;
                router.push("/admin");
            }
        })
        .catch((e) => {
            errors.value = e.response.data.message;
        });
};
</script>
