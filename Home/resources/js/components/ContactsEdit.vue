<template>
  <div>
    <div class="flex w-24 bg-blue-500 hover:bg-blue-700 py-1 px-4 rounded">
      <a href="#" @click="$router.back()">&#171; Back</a>
    </div>
    <form @submit.prevent="submitData">
      <InputField
        name="name"
        label="Contact Name"
        :errors="errors"
        placeholder="Contact Name"
        @update="updateName"
        :data="form.name"
      ></InputField>
      <InputField
        name="email"
        label="Contact Email"
        :errors="errors"
        placeholder="Contact Email"
        @update="updateEmail"
        :data="form.email"
      ></InputField>
      <InputField
        name="company"
        label="Company"
        :errors="errors"
        placeholder="Company"
        @update="updateCompany"
        :data="form.company"
      ></InputField>
      <InputField
        name="birthday"
        label="Birthday"
        :errors="errors"
        placeholder="MM/DD/YYYY"
        @update="updateBirthday"
        :data="form.birthday"
      ></InputField>

      <div class="flex justify-end">
        <button class="hover:bg-green-500 text-white bg-green-600 py-2 px-4 rounded">Update Contact</button>
      </div>
    </form>
  </div>
</template>

<script>
import InputField from "./InputField.vue";

export default {
  name: "ContactsEdit",
  components: {
    InputField
  },
  data: function() {
    return {
      form: {
        name: "",
        email: "",
        company: "",
        birthday: ""
      },
      errors: null
    };
  },
  mounted() {
    axios
      .get("/api/contacts/" + this.$route.params.id)
      .then(response => {
        let info = response.data.data;
        this.form.name = info.name;
        this.form.email = info.email;
        this.form.company = info.company;
        this.form.birthday = info.birthday;
        this.loading = false;
      })
      .catch(error => {
        this.loading = false;

        if (error.response.status === 404) {
          this.$router.push("/contacts");
        }
      });
  },

  methods: {
    submitData() {
      axios
        .put("/api/contacts/" + this.$route.params.id, this.form)
        .then(response => {
          this.$router.push("/contacts");
        })
        .catch(errors => {
          this.errors = errors.response.data.errors;
        });
    },
    updateName(value) {
      this.form.name = value;
    },
    updateEmail(value) {
      this.form.email = value;
    },
    updateCompany(value) {
      this.form.company = value;
    },
    updateBirthday(value) {
      this.form.birthday = value;
    }
  }
};
</script>

<style scope></style>