<template>
  <div class="bg-gray-800 text-yellow-400">
    <div>
      <Navbar />
    </div>
    <div class="row" id="">
      <div class="col-xl-8 text-center p-3 m-4">
        <h3 class="text-3xl mb-4">Top tendances</h3>

        <v-carousel cycle :show-arrows="false" class="text-center">
          <v-carousel-item
            v-for="(popularM, i) in popular"
            :key="i"
            
            
            :title="popularM.title"
            ><h1 class="text-center mb-3">
              <nuxt-link :to="'/movies/' + popularM.id">{{
                popularM.title
              }}
              <img aspect-ratio="1.4" :src="'http://image.tmdb.org/t/p/original' + popularM.backdrop_path" alt="">
              </nuxt-link>
            </h1></v-carousel-item
          >
        </v-carousel>
      </div>
      <div
        class="col-xl-3 bg-gray-800 text-yellow-400 p-3 m-4 justify-center overflow-auto"
        id="hRight"
      >
        <div class="">
          <h2 class="text-2xl mb-4">Films à venir</h2>
          <div v-for="incom in incoming" :key="incom.id">
            {{ incom.title }}
            <nuxt-link :to="'/movies/' + incom.id">
            <img
              :src="'http://image.tmdb.org/t/p/w185' + incom.poster_path"
              alt=""
            />
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      id: this.$route.params.id,
      incoming: [],
      kw: [],
      keyword: "",
      popular: [],
    };
  },
  methods: {
    async incomingMovies() {
      try {
        const response = await axios.get(
          "https://api.themoviedb.org/3/movie/upcoming?api_key=883994e321728f9053b9247358de5998"
        );
        {
          this.incoming = response.data.results;
          console.log(response);
        }
      } catch (e) {
        console.error(e);
      }
    },
    async byKeyword() {
      try {
        const response = await axios.get(
          `https://api.themoviedb.org/3/search/movie?query=${this.keyword}&api_key=883994e321728f9053b9247358de5998&page=1`
        );
        {
          this.kw = response.data.results;
        }
      } catch (e) {
        console.error(e);
      }
    },
    async popularMovies() {
      try {
        const response = await axios.get(
          "https://api.themoviedb.org/3/movie/top_rated?api_key=883994e321728f9053b9247358de5998"
        );
        {
          this.popular = response.data.results;
        }
      } catch (e) {
        console.error(e);
      }
    },
  },
  mounted() {
    this.incomingMovies();
    this.popularMovies();

  },
};
</script>

<style>
#hRight {
  height: 535px;
}
.row {
  margin: 0 !important;
}
</style>
