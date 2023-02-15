<template>
    <h1>Create Competition</h1>
    <div class="justify-content-around flex align-items-center">
        <div class="flex">
            <img class="logo" src="" alt="LOGO" />
            <h1 class="logo-name">SportsEvents</h1>
        </div>
        <div class="flex">
            <ul class="no-list-style flex">
                <li class="m-3">
                    <Button label="Login" />
                </li>
                <li class="m-3">
                    <Button label="Register" />
                </li>
                <li class="m-3">
                    <Button @click="logout" label="Log Out" />
                </li>
            </ul>
            <img class="cart" src="" alt="icon" />
            <img class="user" src="" alt="icon" />
        </div>
    </div>
    <div class="flex flex-column">
        <div class="m-auto">
            <h2>Add new competition</h2>
            <div class="input-grid">
                <div>
                    <p>
                        <InputText
                            class=""
                            type="text"
                            placeholder="Enter competition name"
                            v-model="form.name"
                        />
                    </p>
                    <p>
                        <InputText
                            class=""
                            type="text"
                            placeholder="Age group(kids,teens,adults)"
                            v-model="form.ageGroup"
                        />
                    </p>
                </div>
                <div>
                    <p>
                        <InputText
                            class=""
                            type="date"
                            placeholder="Enter date and time of competition"
                            v-model="date.day"
                        />
                    </p>
                    <p>
                        <InputText
                            class=""
                            type="time"
                            placeholder="Enter date and time of competition"
                            v-model="date.time"
                        />
                    </p>
                </div>
                <div>
                    <p>
                        <InputText
                            class=""
                            type="text"
                            placeholder="'M' for Male 'F for Female'"
                            v-model="form.sex"
                        />
                    </p>
                    <p>
                        <InputText
                            class=""
                            type="text"
                            placeholder="Number of participants"
                            v-model="form.participants"
                        />
                    </p>
                </div>
                <div>
                    <Checkbox v-model="form.timeNotScore" :binary="true" />
                    Check for time, leave for score
                    <p>
                        <Checkbox v-model="form.bigScoreWins" :binary="true" />
                        Check if the biggest score wins
                    </p>

                    <p class="text-danger" v-for="error in errors" :key="error">
                        <span v-for="err in error" :key="err">{{ err }} </span>
                    </p>
                </div>
                <p>
                    <Button
                        @click="saveCompetition"
                        label="Save"
                        class="p-button-rounded"
                    />
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const date = ref({
    day: "",
    time: "",
});
const form = ref({
    name: "",
    category:"",
    ageGroup: "",
    startTime: "",
    sex: "",
    participants: "",
    timeNotScore: false,
    bigScoreWins: false,
});
const errors = ref([]);
const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
};
const saveCompetition = async () => {
    form.value.startTime = date.value.day + " " + date.value.time;
    await axios
        .post("/api/createDiscipline", { ...form.value })
        .then(() => {
            Object.keys(form.value).forEach((key) => (form.value[key] = ""));
            router.push("/admin/");
        })
        .catch(() => {
            console.log("error");
        });
};
</script>
<style>
.input-grid {
    margin: auto;
    display: grid;
    align-items: center;
    grid-template-columns: repeat(4, 250px);
    grid-template-rows: repeat(2, 1fr);
    grid-column-gap: 0px;
    grid-row-gap: 0px;
}
</style>
