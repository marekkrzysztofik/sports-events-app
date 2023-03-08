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
                        (form.type == 'coach' && userTypeChosen == true) ||
                        (form.type == 'referee' && userTypeChosen == true)
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
import { ref, onMounted } from "vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { user } from "/resources/modules/Organizer/composables/user.js";
onMounted(() => {
    getUsers();
});
const userTypeChosen = ref(false);
const users = ref([]);
const getUsers = async () => {
    const response = await axios.get("/api/getUsers");
    users.value = response.data;
    console.log(users.value);
};
const router = useRouter();
const types = ["admin", "coach", "referee"];
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
const register = async () => {
    await axios
        .post("/api/register", form)
        .then((response) => {
            if (response.data.success) {
                localStorage.setItem("token", response.data.data.token);
                if (form.type == "admin") {
                    user.value.id = response.data.data.id;
                } else {
                    user.value.id = response.data.data.user_id;
                }
                user.value.type = response.data.data.type;
                router.push("/admin");
            }
        })
        .catch((e) => {
            errors.value = e.response.data.message;
        });
};
</script>
