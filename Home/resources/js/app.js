import Vue from "vue";
import router from "./router.js";
import "@fortawesome/fontawesome-free/css/all.css";

import App from "./components/App.vue";

require("./bootstrap");

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    router
});
