<template>
  <div>
    <form @submit.prevent="submitData">
      <InputField
        name="name"
        label="Contact Name"
        :errors="errors"
        placeholder="Contact Name"
        @update="updateName"
      ></InputField>
      <InputField
        name="email"
        label="Contact Email"
        :errors="errors"
        placeholder="Contact Email"
        @update="updateEmail"
      ></InputField>
      <InputField
        name="company"
        label="Company"
        :errors="errors"
        placeholder="Company"
        @update="updateCompany"
      ></InputField>
      <InputField
        name="birthday"
        label="Birthday"
        :errors="errors"
        placeholder="MM/DD/YYYY"
        @update="updateBirthday"
      ></InputField>

      <div class="flex justify-end">
        <button class="hover:bg-green-500 text-white bg-green-600 py-2 px-4 rounded">Create Contact</button>
      </div>
    </form>
  </div>
</template>

<script>
import InputField from "../../InputField.vue";

export default {
  name: "ContactsCreate",
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
  methods: {
    submitData() {
      axios
        .post("/api/contacts", this.form)
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