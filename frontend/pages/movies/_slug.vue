<template>
  <div class="bg-gray-800 text-yellow-400">
    <div>
      <Navbar />
      <!-- {{ id.slug }}
      {{ idUser }} -->
      <!-- {{ postCom }}  -->
    </div>
    <div class="flex items-center p-12 ">
      <div class="col-xl-3 mx-auto">
        <img
          contain
          :src="'http://image.tmdb.org/t/p/original' + movies.poster_path"
          alt=""
        />
      </div>
      <div class="">
        <div>
          <p class="text-center">{{ movies.title }}</p>
        </div>

        <div class="mt-12 ml-4">
          <h1 class="text-white">Overview:</h1>
          <p>{{ movies.overview }}</p>
          <div>
            <p class="mt-3 text-white">Release date:</p>
            {{ movies.release_date }}
          </div>
          <div>
            <p class="mt-3 text-white">Vote average:</p>
            {{ movies.vote_average }}
          </div>
          <div>
            <p class="mt-3 text-white">Vote count:</p>
            {{ movies.vote_count }}
          </div>
          <div>
            <button type="submit" @click="addToWishlist()">❤</button>
          </div>
        </div>
      </div>
    </div>
    <div class="">
      <div class="">
        <h1 class="text-center text-3xl">Review</h1>
        <div></div>

        <div class="mx-auto col-xl-12">
          <label for="commentaire">
            <input
              type="text"
              name="commentaire"
              v-model="commentaire"
              id="commentaire"
              class="rounded-lg border-white border-2  text-center bg-gray-500"
            />
          </label>
          <button type="submit" @click="postComment()">Send review</button>
        </div>

        <div
          v-for="user in totuser"
          :key="user.id"
          class="col-xl-8 mx-auto rounded-t-lg border-gray-600 border-2 m-4"
        >
          <p>id user: {{ user.id }}</p>

          <p>{{ user.commentaire }}</p>
        </div>
      </div>

      <div
        v-for="reviews in review"
        :key="reviews.id"
        class="col-xl-8 mx-auto rounded-t-lg border-gray-600 border-2 m-4"
      >
        <div
          class="mb-4 flex items-center rounded-lg border-gray-600 border-2 w-56"
        >
          <img
            contain
            :src="
              'http://image.tmdb.org/t/p/original' +
                reviews.author_details.avatar_path
            "
            alt=""
            class="rounded col-xl-7"
          />
          {{ reviews.author }}:
        </div>
        <div>{{ reviews.content }}</div>
      </div>
      <div class="row ">
        <h1 class="text-center col-xl-12">Similars Films</h1>
        <div class="col-xl-10 d-flex overflow-auto mx-auto justify-center">
          <div class="col-xl-2" v-for="similars in similar" :key="similars.id">
            <nuxt-link :to="'/movies/' + similars.id">
              <img
                contain
                :src="
                  'http://image.tmdb.org/t/p/original' + similars.poster_path
                "
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
      id: this.$route.params,
      review: [],
      totuser: [],
      postCom: [],
      similar: [],
      commentaire: "",
      idUser: "",
    };
  },
  async asyncData({ params, $axios }) {
    const movies = await $axios.$get(
      `https://api.themoviedb.org/3/movie/${params.slug}?api_key=883994e321728f9053b9247358de5998&page=1`
    );
    return { movies };
  },
  methods: {
    async addToWishlist() {
      try {
        const response = await axios.post(
          `http://127.0.0.1:8000/api/com/user`,
          {
            movieid: this.id.slug,
            userid: this.idUser,
          }
        );
        console.log(response);
        alert("added to your wishlist! 🙂");
      } catch (error) {
        console.log(error);
      }
    },
    async getReviewId() {
      try {
        const response = await axios.get(
          `https://api.themoviedb.org/3/movie/${this.id.slug}/reviews?api_key=883994e321728f9053b9247358de5998&page=1`
        );
        this.review = response.data.results;
      } catch (error) {
        console.error(error);
      }
    },
    async getSimilarMovies() {
      try {
        const response = await axios.get(
          `https://api.themoviedb.org/3/movie/${this.id.slug}/similar?api_key=883994e321728f9053b9247358de5998&page=1`
        );
        this.similar = response.data.results;
      } catch (error) {
        console.error(error);
      }
    },
    async postComment() {
      try {
        const response = await axios.post("http://127.0.0.1:8000/api/com", {
          user_id: this.idUser,
          movie_id: this.id.slug,
          commentaire: this.commentaire,
        });

        this.postCom = response.config.data;
        window.location.reload();
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
    async getComment() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/movies/com/${this.id.slug}`
        );

        this.totuser = response.data;
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
    this.getReviewId();
    this.getSimilarMovies();
    this.getComment();
  },
};
</script>

<style>
.row {
  margin: 0 !important;
}
</style>
