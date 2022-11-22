<template>
  <div class="bg-gray-800 text-yellow-400">
    <div>
      <Navbar />
    </div>
    <div>
        <h1>My movies</h1>
        <div v-for="mymovies in mymovie" :key="mymovies.id">
            {{mymovies.movie_id}}
        </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      mymovie: [],
      
    };
  },
  methods: {
    async getMyMovies() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/com/user/${this.idUser}`
        );
        this.mymovie = response.data.com;
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
  },
  async mounted() {
    try {
      const response = await fetch("http://localhost:8000/api/user", {
        headers: { "Content-Type": "application/json" },
        credentials: "include",
      });
      const content = await response.json();
      this.message = "Bonjour " + content.name;
      this.idUser = content.id;
      this.auth = true;
    } catch (e) {
      this.message = "";
      this.auth = false;
    }
    this.getMyMovies();
  },
};
</script>

<style></style>
