<template>
    <div class="justify-content-around flex align-items-center">
        <div class="flex">
            <h1 class="logo-name">SportsEvents</h1>
        </div>
        <div class="flex">
            <ul class="no-list-style flex">
                <li class="m-3">
                    <router-link
                        v-if="$route.name === 'Home'"
                        to="/login"
                        class="no-decoration"
                        ><Button label="Login"
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
                <li v-if="$route.name !== 'Home'" class="m-3">
                    <router-link to="/" class="no-decoration"
                        ><Button label="Home"
                    /></router-link>
                </li>
                <li class="m-3">
                    <router-link to="/admin/disciplines" class="no-decoration"
                        ><Button label="Disciplines"
                    /></router-link>
                </li>
                <li class="m-3">
                    <router-link
                        v-if="user.type == 'Admin' || user.type == 'Referee'"
                        to="/admin/competitors"
                        class="no-decoration"
                        ><Button label="Competitors"
                    /></router-link>
                </li>
                <li
                    v-if="
                        $route.name == 'AdminHome'
                    "
                    class="m-3"
                >
                    <Button @click="logout" label="Log Out" />
                </li>
                <li v-if="user.type == 'Admin'" class="m-3">
                    <router-link to="/admin/create" class="no-decoration"
                        ><Button label="Create competition"
                    /></router-link>
                </li>
                <li
                    v-if="user.type == 'Admin' || user.type == 'Coach'"
                    class="m-3"
                >
                    <router-link
                        to="/admin/add-competitor"
                        class="no-decoration"
                        ><Button label="Add competitor"
                    /></router-link>
                </li>
                <li
                    v-if="user.type == 'Coach' || user.type == 'Admin'"
                    class="m-3"
                >
                    <router-link to="/admin/choose" class="no-decoration"
                        ><Button label="Add to competition"
                    /></router-link>
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
</script>
