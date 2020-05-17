require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import { Form, HasError, AlertError } from "vform";
import moment from "moment";
import VueProgressBar from "vue-progressbar";
import Swal from "sweetalert2";
import Gate from './Gate';
import Swiper from 'swiper';

Vue.prototype.$gate = new Gate(window.user);

// MAP
var mymap = L.map('mapid').setView([-43.541305, 172.696977], 15);
L.tileLayer('https://api.mapbox.com/styles/v1/dpisati/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'ckaamrjux14ls1ipf1g8u05nd',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZHBpc2F0aSIsImEiOiJja2FhbTZ0anoxNjdtMnJxdm1wb3A3b3oyIn0.KkdcCPaC1EfZlZ1OZD883g'
}).addTo(mymap);
var marker = L.marker([-43.541305, 172.696977]).addTo(mymap);
// MAP END

var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
    rotate: 20,
    stretch: 0,
    depth: 300,
    modifier: 1,
    slideShadows : false,
    },
    loop: true,
  });


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

Vue.component("passport-clients", require("./components/passport/Clients.vue").default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component("passport-authorized-clients", require("./components/passport/AuthorizedClients.vue").default);
Vue.component("passport-personal-access-tokens", require("./components/passport/PersonalAccessTokens.vue").default);
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
        search: ''
    },
    methods: {
        searchThis: _.debounce(() => {
            Fire.$emit('searching');
        },1000)
    }
});
