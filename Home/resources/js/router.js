import Vue from "vue";
import VueRouter from "vue-router";
import Index from "./components/Index.vue";
import ContactsCreate from "./components/Personal/ContactsCreate.vue";
import ContactsShow from "./components/Personal/ContactsShow.vue";
import ContactsEdit from "./components/Personal/ContactsEdit.vue";
import ContactsIndex from "./components/Personal/ContactsIndex.vue";

import BirthdaysIndex from "./components/Personal/BirthdaysIndex.vue";

import BudgetManager from "./components/Financial/BudgetManager.vue";
import Calculator from "./components/Financial/Calculator.vue";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: "/", component: Index },
        { path: "/contacts", component: ContactsIndex },
        { path: "/contacts/create", component: ContactsCreate },
        { path: "/contacts/:id", component: ContactsShow },
        { path: "/contacts/:id/edit", component: ContactsEdit },
        { path: "/birthdays", component: BirthdaysIndex },
        { path: "/budgetManager", component: BudgetManager },
        { path: "/calculator", component: Calculator }
    ],
    mode: "history"
});
