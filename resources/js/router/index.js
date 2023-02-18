import { createRouter, createWebHistory } from "vue-router";
import NotFound from "../components/NotFound.vue";
import Login from "/resources/modules/Organizer/components/Auth/Login.vue";
import Home from "../components/Home.vue";
import AdminHome from "/resources/utils/AdminHome.vue";
import CreateDiscipline from "/resources/utils/CreateDiscipline.vue";
import EditDiscipline from "/resources/utils/EditDiscipline.vue";
import EditCompetitor from "/resources/utils/EditCompetitor.vue";
import AddCompetitor from "/resources/utils/AddCompetitor.vue";
import Competitors from "/resources/utils/Competitors.vue";
import Register from "/resources/modules/Organizer/components/Auth/Register.vue";
const routes = [
    //admin
    {
        path: "/",
        component: Home,
        name: "Home",
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/admin",
        component: AdminHome,
        name: "AdminHome",
        meta: {
            requiresAuth: true,
        },
    }, 
    {
        path: "/admin/create",
        component: CreateDiscipline,  
        name: "CreateDiscipline",
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/edit-discipline/:id",
        component: EditDiscipline,  
        name: "EditDiscipline",
        props: true,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/edit-competitor/:id",
        component: EditCompetitor,  
        name: "EditCompetitor",
        props: true,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/add-competitor",
        component: AddCompetitor,  
        name: "AddCompetitor",
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/admin/competitors",
        component: Competitors,  
        name: "Competitors",
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: NotFound,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
        meta: {
            requiresAuth: false,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
        return { name: "Login" };
    }
    if (to.meta.requiresAuth == false && localStorage.getItem("token")) {
        return { name: "AdminHome" };
    }
});

export default router;
