require("./bootstrap"); //Bootstrp Calling

window.Vue = require("vue").default; //Vue Calling
import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);
import Myheader from "./components/Myheader";
import routes from "./routes";
import Swal from "sweetalert2";
window.Swal=Swal

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

window.Toast=Toast

// Vue Router Instance
const router = new VueRouter({
    mode : "history",
    routes
});

const app = new Vue({
    el: "#app",
    router,
    components: {
        Myheader
    }
}); //Vue instance

//vue route : Allow Page Navigation without Refresh
