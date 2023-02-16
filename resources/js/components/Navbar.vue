<template>
    <div class="justify-content-around flex align-items-center">
        <div class="flex">
            <img class="logo" src="" alt="LOGO" />
            <h1 class="logo-name">SportsEvents</h1>
        </div>
        <div class="flex">
            <ul class="no-list-style flex">
                <li class="m-3">
                    <router-link to="/login" class="no-decoration"
                        ><Button label="Login"
                    /></router-link>
                </li>
                <li class="m-3">
                    <router-link to="/register" class="no-decoration"
                        ><Button label="Register"
                    /></router-link>
                </li>
                <li class="m-3">
                    <Button @click="logout" label="Log Out" />
                </li>
            </ul>
            <img class="cart" src="" alt="icon" />
            <img class="user" src="" alt="icon" />
        </div>
    </div>
</template>
<script setup>
import {useRouter} from 'vue-router'
const router = useRouter()
const logout = () => {
    localStorage.removeItem("token");
    router.push("/");
};
</script>