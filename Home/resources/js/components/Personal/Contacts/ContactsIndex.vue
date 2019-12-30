<template>
  <ContactsList endpoint="/api/contacts"></ContactsList>
</template>

<script>
import ContactsList from "./ContactsList";

export default {
  name: "ContactsIndex",
  components: {
    ContactsList
  }
};
</script>


<style scoped></style>