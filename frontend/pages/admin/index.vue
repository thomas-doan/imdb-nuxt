<template>
<div id="mainBody">
    <h1 class="text-center">Admin</h1>
    <div class="d-flex justify-content-around">
      <b-button v-b-toggle.collapse-3 class="m-1">Afficher les Utilisateurs</b-button>
      <nuxt-link to="/"
        ><b-button class="btn-danger">Back to Home</b-button></nuxt-link
      >
      <b-button v-b-toggle.collapse-2 class="m-1">Afficher les films</b-button>
      
    </div>

    <div>
      <div>
        <div class="col-12">
          <b-collapse id="collapse-3">
            <b-card>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>

                    <th>
                      <nuxt-link to="/admin/add"
                        ><button
                          class="btn btn-primary justify-content-center d-flex"
                        >
                          Add User
                        </button></nuxt-link
                      >
                    </th>
                  </tr>
                </thead>
                <tbody v-for="user in users" :key="user">
                  <tr>
                    
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.admin }}</td>
                    <td class="justify-content-around d-flex">
                      <nuxt-link v-bind:to="'/admin/' + user.id"
                        ><button class="btn btn-success">
                          Update
                        </button></nuxt-link
                      >
                      <!-- <nuxt-link v-bind:to="'/admin/' + user.id"
                        > --> <button @click="deleteUser(user.id)"  class="btn btn-danger">
                          Remove  
                        </button> <!-- </nuxt-link> -->
                      
                    </td>
                  </tr>
                </tbody>
              </table>
            </b-card>
          </b-collapse>
        </div>
      </div>
    </div>


     <div class="col-12">
      <b-collapse id="collapse-2">
        <b-card>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>nom film</th>
                <th>Genres</th>
                <th>director</th>
                <th>date</th>
                <th></th>
                <th>
                  <router-link to="/addfilm"
                    ><button class="btn btn-primary">
                      Add film
                    </button></router-link
                  >
                </th>
              </tr>
            </thead>
            <tbody v-for="film in films" :key="film.id">
              <tr>
                <td>{{ film.id }}</td>
                <td>{{ film.nom }}</td>
                <td>{{ film.genres }}</td>
                <td>{{ film.director }}</td>
                <td>{{ film.date}}</td>
                <td class="justify-content-around d-flex">
                  <router-link v-bind:to="'/updatefilm/' + film._id"
                    ><button class="btn btn-success">
                      Update
                    </button></router-link
                  >
                  <router-link v-bind:to="'/removefilm/' + film._id"
                    ><button class="btn btn-danger">Remove</button></router-link
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-collapse>
    </div>
 
</div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      id:[],
      users: [],
    };
  },
  methods: {


    async deleteUser(userid) {
      try {
        const response = await axios.delete(
          "http://127.0.0.1:8000/api/user/" + userid
        );
        this.user = response.data;
        console.log(this.user);
        if (response) {
          try {
            alert("User deleted with success!");
            await this.$router.go({path:'/admin', force: true});
          } catch (e) {
            console.error(e);
          }
        }
      } catch (error) {
        console.error(error);
      }
    },



    
    async displayUsers() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/users");
        this.users = response.data;
        console.log(this.users);
      } catch (error) {
        console.error(error);
      }
    },


  },
  mounted() {
    this.displayUsers();
  },
};
</script>

<style>
#mainBody {
  background-color: #3c4e55;
}
</style>
