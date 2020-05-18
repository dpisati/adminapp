require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import { Form, HasError, AlertError } from "vform";
import moment from "moment";
import VueProgressBar from "vue-progressbar";
import Swal from "sweetalert2";
import Gate from "./Gate";

$(".nav-link a").on("click", function() {
    $(".menu-icon").click();
});

Vue.prototype.$gate = new Gate(window.user);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

Vue.use(VueRouter);
Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "3px"
});

Vue.component(
    "passport-clients",
    require("./components/passport/Clients.vue").default
);
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(
    "passport-authorized-clients",
    require("./components/passport/AuthorizedClients.vue").default
);
Vue.component(
    "passport-personal-access-tokens",
    require("./components/passport/PersonalAccessTokens.vue").default
);
Vue.component("not-found", require("./components/NotFound.vue").default);
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.filter("upText", function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter("myDate", function(date) {
    return moment(date).format("DD/MM/YY - hh:mm:ss a");
});
window.Fire = new Vue();
window.Swal = Swal;
window.Toast = Toast;
window.Form = Form;

const app = new Vue({
    el: "#app",
    router: new VueRouter(routes),
    data: {
        search: ""
    },
    methods: {
        searchThis: _.debounce(() => {
            Fire.$emit("searching");
        }, 1000)
    }
});
