<template>
  <div>
    <form>
      <div class="relative pb-3">
        <label
          class="text-blue-700 text-bold uppercase absolute pt-2 text-sm"
          :for="name"
        >{{ label }}</label>
        <input
          class="text-gray-700 pt-8 w-full border-b focus:border-blue-400 focus:outline-none"
          :id="name"
          type="text"
          :class="errorClassObject(name)"
          :placeholder="placeholder"
          @input="updateField(name)"
          v-model="value"
        />
        <p class="text-red-700 text-sm" v-text="errorMessage(name)"></p>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "InputField",

  props: ["name", "label", "placeholder", "errors", "data"],

  data: function() {
    return {
      value: ""
    };
  },

  methods: {
    updateField(name) {
      this.clearErrors(name);
      this.$emit("update", this.value);
    },
    errorMessage(name) {
      if (this.errors && this.errors[name]) {
        return this.errors[name][0];
      }
    },
    clearErrors(name) {
      if (this.errors && this.errors[name]) {
        this.errors[name] = null;
      }
    },

    // If true, then we apply this class defined below
    errorClassObject(name) {
      return {
        "error-field": this.errors && this.errors[name]
      };
    }
  },
  watch: {
    data: function(value) {
      this.value = value;
    }
  }
};
</script>

<style scope>
.error-field {
  @apply border-red-500;
  @apply border-b-2;
}
</style>