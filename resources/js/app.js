require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";

import MainApp from "./components/MainApp.vue";

import storeData from "./store";
import { routes } from "./routes";
import { initialize } from "./helpers/general";
import Swal from "sweetalert2";

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

window.Swal = Swal;
window.Toast = Toast;

Vue.use(Vuex);
Vue.use(VueRouter);

const store = new Vuex.Store(storeData);
const router = new VueRouter({
    routes,
    mode: "history"
});

initialize(store, router);

const app = new Vue({
    el: "#app",
    store,
    router,
    components: {
        MainApp
    }
});
