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
          :placeholder="placeholder"
          @input="updateField()"
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
    updateField() {
      this.$emit("update", this.value);
    },
    errorMessage(name) {
      if (this.errors && this.errors[name]) {
        return this.errors[name][0];
      }
    }
  },
  watch: {
    data: function(value) {
      this.value = value;
    }
  }
};
</script>

<style scope></style>