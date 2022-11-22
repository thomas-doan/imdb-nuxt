<template>
  <div>
    <h1>Remove</h1>
    <div class="col-xl-12 d-flex justify-content-around">
      <div class="form-group col-xl-6 p-3">
        <div>
          <label for="ID">ID:</label>
          <span class="pl-2">{{ user._id }}</span>
        </div>
        <div>
          <label for="name">Name:</label>
          <span class="pl-2">{{ user.name }}</span>
        </div>
        <div>
          <label for="email">Email:</label>
          <span class="pl-2">{{ user.email }}</span>
        </div>
        <div>
          <label for="roles">Roles:</label>
          <span class="pl-2">{{ user.roles }}</span>
        </div>
        <button
          type="submit"
          v-on:click="deleteUser()"
          class="btn btn-danger d-flex justify-content-center mt-4"
        >
          Delete
        </button>
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
      user: [],
      email: "",
      name: "",
      roles: [""],
    };
  },
 /*  created() {
    axios.get("http://127.0.0.1:8000/api/users" + this.id).then((data) => {
      console.log(data);
      this.user = data.data;
    });
  }, */

  async asyncData({params, $axios}) {
    console.log(params.id);
        const user = await $axios.get(
          `http://127.0.0.1:8000/api/user/`+ params.id
        );
        return {user}
    },

  methods: {
    async deleteUser() {
      try {
        const response = await axios.delete(
          "http://127.0.0.1:8000/api/user/" + this.id
        );
        this.user = response.data;
        console.log(this.user);
        if (response) {
          try {
            alert("User deleted with success!");
            this.$router.push("/admin");
          } catch (e) {
            console.error(e);
          }
        }
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style></style>
