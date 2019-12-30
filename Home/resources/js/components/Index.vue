<template>
  <div class="mt-10 font-mono">
    <p class="text-5xl text-center">Welcome {{ user.name }}</p>
    <p class="pt-5 text-4xl text-center">{{ new Date().toLocaleDateString() }}</p>
  </div>
</template>

<script>
export default {
  mounted() {
    axios
      .get("/api/homepage")
      .then(response => {
        this.user = response.data;
        console.log(this.user);
      })
      .catch(error => {
        console.log(error);
      });
  },
  data: function() {
    return {
      user: ""
    };
  }
};
</script>

<style scoped>
</style>
