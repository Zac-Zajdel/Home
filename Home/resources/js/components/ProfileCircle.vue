<template>
  <div>
    <div
      class="flex justify-center items-center text-white rounded-full border border-gray-400 w-10 h-10 bg-blue-500"
    >{{ profileCircle }}</div>
  </div>
</template>
  
<script>
export default {
  name: "ProfileCircle",
  props: ["name"],
  computed: {
    profileCircle: function() {
      return this.name.charAt(0);
    }
  }
};
</script>

<style scoped></style>