<template>
  <div>
    <h1>Update</h1>
    <div class="col-xl-12 d-flex justify-content-around">
      <div class="form-group col-xl-6 p-3">
        <label for="name">Name:</label>
        <span class="pl-2">{{ user.name }}</span>
        <input
          v-model="name"
          type="text"
          id="name"
          class="form-control"
          placeholder="New name"
        />

        <label for="email">Email:</label>
        <span class="pl-2">{{ user.email }}</span>
        <input
          v-model="email"
          type="email"
          v-html="user.email"
          id="email"
          class="form-control"
          placeholder="New email"
        />

        <label for="email">password:</label>
        <span class="pl-2">{{ user.password }}</span>
        <input
          v-model="password"
          type="password"
          v-html="user.password"
          id="password"
          class="form-control"
          placeholder="New email"
        />


         <label for="roles">Admin:</label>
        <span class="pl-2">{{ user.admin }}</span>
        <input
          v-model="admin"
          type="admin"
          id="admin"
          class="form-control"
          placeholder="Admin ?"
        /> 
        <button
          type="submit"
          v-on:click="putUser()"
          class="btn btn-success d-flex justify-content-center mt-4"
        >
          Submit
        </button>
        <router-link to="/admin"
          ><button class="btn btn-danger">Back</button></router-link
        >
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
      admin: "",
      password: "",
    };
  },

  methods: {
    async putUser() {
      try {
        const response = await axios.put(
          `http://localhost:8000/api/user/${this.id.update}`,
          //{ headers: { 'Access-Control-Allow-Origin': '*' } },
          { email: this.email, name: this.name, password: this.password, admin: this.admin }
        );
        this.user = response.data;
        console.log(this.user);
        if (response) {
          try {
            alert("User modified with success!");
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
