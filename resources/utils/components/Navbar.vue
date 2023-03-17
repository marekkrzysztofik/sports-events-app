<template>
    <div class="justify-content-center flex align-items-center">
        <div class="flex align-items-center">
            <div>
                <img src="../../../images/logo.png" alt="logo" class="logo" />
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
                <li v-if="user.type == 'Admin'" class="m-3">
                    <router-link to="/admin/create" class="no-decoration"
                        ><Button label="Create competition"
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
                        ><Button label="Competitors"
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
                        ><Button label="Competitions"
                    /></router-link>
                </li>
                <li
                    v-if="user.type == 'Coach' || user.type == 'Admin'"
                    class="m-3"
                >
                    <SplitButton label="Add" icon="pi pi-plus" :model="items" />
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
</template>
<script setup>
import { useRouter } from "vue-router";
import { user } from "/resources/modules/Organizer/components/Auth/user.js";
const router = useRouter();
const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
    location.reload();
};
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
</script>
<style></style>
