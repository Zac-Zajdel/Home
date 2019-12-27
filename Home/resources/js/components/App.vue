<template>
  <div class="h-screen bg-white font-mono">
    <div class="flex">
      <div class="bg-gray-200 w-48 h-auto border-r-2 border-gray-400">
        <nav class="pt-3 pl-6">
          <router-link to="/">
            <h3 class="text-blue-700 text-2xl text-left">Home</h3>
          </router-link>

          <p class="pt-12 text-gray-500 uppercase text-xs">Create</p>
          <router-link
            to="/contacts/create"
            class="flex items-center text-blue-700 hover:text-blue-500"
          >
            <div class="tracking-wide">Add New Contact</div>
          </router-link>

          <p class="pt-12 text-gray-500 uppercase text-xs">Personal</p>
          <router-link to="/contacts" class="flex items-center text-blue-700 hover:text-blue-500">
            <div class="tracking-wide">Contacts</div>
          </router-link>
          <router-link to="/birthdays" class="flex items-center text-blue-700 hover:text-blue-500">
            <div class="tracking-wide">Birthdays</div>
          </router-link>

          <p class="pt-12 text-gray-500 uppercase text-xs">Financial</p>
          <router-link
            to="/budgetManager"
            class="flex items-center text-blue-700 hover:text-blue-500"
          >
            <div class="tracking-wide">Budget Manager</div>
          </router-link>
          <router-link to="/calculator" class="flex items-center text-blue-700 hover:text-blue-500">
            <div class="tracking-wide">Calculator</div>
          </router-link>

          <p class="pt-12 text-gray-500 uppercase text-xs">Settings</p>
          <div class="flex items-center text-blue-700 hover:text-blue-500">
            <button @click="logout" class="tracking-wide">Logout</button>
          </div>
        </nav>
      </div>

      <div class="flex flex-col flex-auto h-screen overflow-y-hidden">
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-400">
          <div></div>
          <!-- TODO: Add Breadcrumbs For Better UX -->
          <ProfileCircle :name="user.name"></ProfileCircle>
        </div>
        <div class="flex flex-col overflow-y-hidden flex-auto">
          <router-view class="overflow-x-hidden p-6"></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProfileCircle from "./ProfileCircle.vue";

export default {
  name: "App",
  components: {
    ProfileCircle
  },
  props: ["user"],
  created() {
    window.axios.interceptors.request.use(config => {
      if (config.method === "get") {
        config.url = config.url + "?api_token=" + this.user.api_token;
      } else {
        config.data = {
          ...config.data,
          api_token: this.user.api_token
        };
      }
      return config;
    });
  },
  methods: {
    logout: function() {
      axios.post("/logout", {}).finally(err => {
        window.location = "/login";
      });
    }
  }
};
</script>

<style scoped></style>
