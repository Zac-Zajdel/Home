<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div class="flex flex-col pt-20" v-if="contacts.length === 0">
        <p class="text-center">No Contacts Yet</p>
        <router-link
          class="text-center pt-10 text-2xl hover:text-blue-600"
          to="/contacts/create"
        >Create Your First Contact</router-link>
      </div>
      <div v-else>
        <div v-for="(contact, index) in contacts" :key="index">
          <router-link
            class="flex items-center border-b border-gray-400 hover:bg-gray-100"
            :to="'/contacts/'
            +
            contact.id"
          >
            <div class="pb-2 pt-2">
              <p class="text-blue-800 font-bold">{{ contact.name }}</p>
              <p class="text-blue-600 text-sm">{{ contact.company }}</p>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactsIndex",
  mounted() {
    axios
      .get("/api/contacts")
      .then(response => {
        this.contacts = response.data;
        this.loading = false;
      })
      .catch(error => {
        this.loading = false;
        console.log(error);
      });
  },
  data: function() {
    return {
      loading: true,
      contacts: null
    };
  }
};
</script>


<style scoped></style>