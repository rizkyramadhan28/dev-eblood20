import Home from "./components/pages/Home.vue";
import Login from "./components/auth/Login.vue";
import Signup from "./components/auth/Signup.vue";
import Hospital from "./components/pages/Hospital.vue";
import NotFound from "./components/pages/NotFound.vue";
import Profile from "./components/users/Profile.vue";
import Update from "./components/users/Update.vue";

export const routes = [
    {
        path: "/",
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/signup",
        component: Signup
    },
    {
        path: "/hospital",
        component: Hospital,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/profile/:id",
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/profile/update/:id",
        component: Update,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "*",
        component: NotFound
    }
];
