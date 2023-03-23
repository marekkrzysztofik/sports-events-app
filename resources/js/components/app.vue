<template>
    <div class="justify-content-center flex align-items-center">
        <div class="flex align-items-center">
            <div>
                <img src="@/images/logo.png" alt="logo" class="logo" />
            </div>
            <div>
                <router-link to="/" class="no-decoration">
                    <h1 class="logo-name m-4">SportsEvents</h1></router-link
                >
            </div>
        </div>
        <div class="flex">
            <ul class="no-list-style flex pad-0">
                <li class="m-3">
                    <router-link
                        v-if="$route.name === 'Home'"
                        to="/login"
                        class="no-decoration"
                        ><Button class="my-button" label="Login"
                    /></router-link>
                </li>
                <li class="m-3">
                    <router-link
                        v-if="$route.name === 'Home'"
                        to="/register"
                        class="no-decoration"
                        ><Button label="Register"
                    /></router-link>
                </li>
                <li class="m-3">
                    <router-link
                        v-if="
                            $route.name != 'Home' &&
                            $route.name != 'Login' &&
                            $route.name != 'Register' &&
                            $route.name != 'Competitors'
                        "
                        to="/admin/competitors"
                        class="no-decoration"
                        ><Button label="Competitors" icon="pi pi-users"
                    /></router-link>
                </li>
                <li
                    v-if="
                        $route.name != 'Home' &&
                        $route.name != 'Login' &&
                        $route.name != 'Register' &&
                        $route.name != 'DisciplinesWithActions'
                    "
                    class="m-3"
                >
                    <router-link to="/admin/disciplines" class="no-decoration"
                        ><Button
                            label="Competitions"
                            icon="pi pi-calendar-times"
                    /></router-link>
                </li>
                <li
                    v-if="userInfo.type == 'Coach' || userInfo.type == 'Admin'"
                    class="m-3"
                >
                    <SplitButton label="Add" icon="pi pi-plus" :model="items" />
                </li>
                <li v-if="userInfo.type == 'Admin'" class="m-3">
                    <router-link to="/admin/create" class="no-decoration"
                        ><Button
                            label="Create competition"
                            icon="pi pi-calendar-plus"
                    /></router-link>
                </li>
                <li
                    v-if="
                        $route.name != 'Home' &&
                        $route.name != 'Login' &&
                        $route.name != 'Register'
                    "
                    class="m-3"
                >
                    <Button
                        @click="logout"
                        label="Log Out"
                        icon="pi pi-power-off"
                    />
                </li>
            </ul>
        </div>
    </div>
    <router-view/>
</template>
<script setup>
import { useRouter } from "vue-router";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

const userInfo = useUserInfo();
const router = useRouter();
const items = [
    {
        label: "New Sportsman",
        icon: "pi pi-user-plus",
        command: () => {
            router.push("/admin/add-competitor");
        },
    },
    {
        label: "Sportsman to competition",
        icon: "pi pi-user-edit",
        command: () => {
            router.push("/admin/choose");
        },
    },
];

const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
    userInfo.$reset();
    location.reload();
};
</script>

 