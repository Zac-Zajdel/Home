<template>
  <div>
    <div
      v-if="focus"
      @click="focus = false"
      class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10"
    ></div>
    <div class="relative z-10">
      <div class="absolute pt-2 pl-3">
        <i class="fas fa-search"></i>
      </div>
      <input
        class="w-64 mr-6 bg-gray-200 border-2 border-gray-400 pl-8 pr-3 px-1 py-1 rounded-full focus:outline-none focus:bg-gray-300 focus:shadow"
        type="text"
        placeholder="Search..."
        id="searchTerm"
        v-model="searchTerm"
        @input="search"
        @focus="focus = true"
      />
      <div
        v-if="focus"
        class="absolute right-0 bg-blue-500 text-white rounded-lg p-4 mr-6 mt-2 shadow z-20 overflow-hidden"
        style="width: 25rem;"
      >
        <div v-if="results == 0">No results found for '{{ searchTerm }}'</div>
        <div v-for="(result, index) in results" :key="index">
          <router-link :key="$route.fullPath" :to="`/contacts/${results[index].contact_id}`">
            <div @click="focus = false" class="flex items-center">
              <ProfileCircle :name="result.name" />
              <div class="pl-5">
                <p>{{ result.name }}</p>
                <p>{{ result.company }}</p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
import ProfileCircle from "./ProfileCircle.vue";

export default {
  name: "SearchBar",
  components: { ProfileCircle },
  data: function() {
    return {
      searchTerm: "",
      focus: false,
      results: []
    };
  },
  methods: {
    search: _.debounce(function(e) {
      if (this.searchTerm.length < 3) {
        return;
      }
      axios
        .post("/api/search", { searchTerm: this.searchTerm })
        .then(response => {
          this.results = response.data.data;
          this.searchTerm = "";
          this.console.log(this.results);
        })
        .catch(error => {
          console.log(error);
        });
    }, 250)
  }
};
</script>

<style></style>
