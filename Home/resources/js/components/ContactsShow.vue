<template>
  <div>
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else>
      <div class="flex items-center justify-between text-sm text-white">
        <div class="bg-blue-500 hover:bg-blue-700 py-1 px-4 rounded">
          <a href="#" @click="$router.back()">&#171; Back</a>
        </div>
        <div class="relative">
          <router-link
            class="py-1 px-4 bg-green-600 hover:bg-green-800 rounded"
            :to="'/contacts/' + contact.id + '/edit'"
          >Edit</router-link>
          <a
            class="py-1 px-4 bg-red-700 hover:bg-red-800 rounded"
            href="#"
            @click="modal = !modal"
          >Delete</a>
          <div
            class="bg-gray-600 rounded text-white absolute z-20 p-5 w-64 right-0 mt-1 mr-6"
            v-if="modal"
          >
            <p
              class="text-white text-center pb-3"
            >Do You Want To Delete {{ contact.name }}'s Contact?</p>
            <div class="flex items-center justify-between">
              <button
                class="flex bg-green-600 hover:bg-green-700 items-center px-3 py-1 rounded text-sm"
                @click="modal = !modal"
              >Cancel</button>
              <button
                class="ml-3 bg-red-700 hover:bg-red-800 px-3 py-1 rounded text-sm"
                @click="deleteContact"
              >Delete</button>
            </div>
          </div>
        </div>
      </div>

      <div class="flex items-center pt-5">
        <p class="text-xl">{{ contact.name }}</p>
      </div>

      <p class="pt-5 text-gray-600 uppercase text-sm">Contact</p>
      <p class="pt-2 text-blue-800">{{ contact.email }}</p>
      <p class="pt-5 text-gray-600 uppercase text-sm">Company</p>
      <p class="pt-2 text-blue-800">{{ contact.company }}</p>
      <p class="pt-5 text-gray-600 uppercase text-sm">Birthday</p>
      <p class="pt-2 text-blue-800">{{ contact.birthday }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactsShow",
  data: function() {
    return {
      contact: {
        name: null,
        email: null,
        company: null,
        birthday: null,
        id: null
      },
      loading: true,
      modal: false
    };
  },
  methods: {
    deleteContact: function() {
      axios
        .delete("/api/contacts/" + this.contact.id)
        .then(response => {
          this.$router.push("/contacts");
        })
        .catch(error => {
          console.log("Error");
        });
    }
  },
  mounted() {
    axios
      .get("/api/contacts/" + this.$route.params.id)
      .then(response => {
        let info = response.data;
        this.contact.name = info.name;
        this.contact.email = info.email;
        this.contact.company = info.company;
        this.contact.birthday = info.birthday;
        this.contact.id = info.id;
        this.loading = false;
      })
      .catch(error => {
        this.loading = false;

        if (error.response.status === 404) {
          this.$router.push("/contacts");
        }
      });
  }
};
</script>

<style scoped></style>