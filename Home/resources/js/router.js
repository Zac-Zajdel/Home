import Vue from "vue";
import VueRouter from "vue-router";
import Index from "./components/Index.vue";
import ContactsCreate from "./components/ContactsCreate.vue";
import ContactsShow from "./components/ContactsShow.vue";
import ContactsEdit from "./components/ContactsEdit.vue";
import ContactsIndex from "./components/ContactsIndex.vue";

import BirthdaysIndex from "./components/BirthdaysIndex.vue";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/", component: Index },
        { path: "/contacts", component: ContactsIndex },
        { path: "/contacts/create", component: ContactsCreate },
        { path: "/contacts/:id", component: ContactsShow },
        { path: "/contacts/:id/edit", component: ContactsEdit },
        { path: "/birthdays", component: BirthdaysIndex }
    ],
    mode: "history"
});
