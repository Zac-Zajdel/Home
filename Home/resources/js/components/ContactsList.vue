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
            contact.contact_id"
          >
            <div class="flex content-start pb-2 pt-2">
              <div class="pr-4">
                <ProfileCircle :name="contact.name"></ProfileCircle>
              </div>
              <div>
                <p class="text-blue-800 font-bold">{{ contact.name }}</p>
                <p class="text-blue-600 text-sm">{{ contact.company }}</p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProfileCircle from "./ProfileCircle.vue";

export default {
  name: "contactsList",
  components: {
    ProfileCircle
  },
  props: ["endpoint"],
  mounted() {
    axios
      .get(this.endpoint)
      .then(response => {
        this.contacts = response.data.data;
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