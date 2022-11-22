<template>
  <div>
    <h1>Add</h1>
    <div class="col-xl-12 d-flex justify-content-around">
      <div class="form-group col-xl-6 p-3">
        <label for="name">Name:</label>
        <input
          v-model="name"
          type="text"
          id="name"
          class="form-control"
          placeholder="Nom"
        />

        <label for="email">Email:</label>
        <input
          v-model="email"
          type="email"
          id="email"
          class="form-control"
          placeholder="Email"
        />

        <label for="Password">Password:</label>
        <input
          v-model="password"
          type="password"
          id="Password"
          class="form-control"
          placeholder="password"
        />

         <label for="admin">admin:</label>
        <input
          v-model="admin"
          type="admin"
          id="admin"
          class="form-control"
          placeholder="admin"
        />

        <button
          type="submit"
          v-on:click="addNewUser()"
          class="btn btn-success d-flex justify-content-center mt-4"
        >
          Submit
        </button>
        <Nuxt-link to="/admin"
          ><button class="btn btn-danger">Back</button></Nuxt-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "add",
  data() {
    return {
      email: "",
      name: "",
      password: "",
      admin: "",
    };
  },
  methods: {
    async addNewUser() {
        try {
     const response = await fetch('http://localhost:8000/api/register', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          name: this.name,
          email: this.email,
          password: this.password,
          admin: this.admin,
        })
      });
      if (response) {
          try {
            alert("User created!");
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

<style>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

