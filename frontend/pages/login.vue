<template>
<main class="form-signin">
  <form @submit.prevent="submit">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <input
      v-model="email"
      type="email"
      class="form-control"
      placeholder="Email"
      required
    />

    <input
      v-model="password"
      type="password"
      class="form-control"
      placeholder="Password"
      required
    />

    <button class="w-100 btn btn-lg btn-primary" type="submit">Envoyé</button>

    <div class="card-footer">
      <div class="d-flex justify-content-center links">
        Pas de compte ?
        <a href="/register"> Enregistrez-vous</a>
      </div>
    </div>
  </form>
  </main>   
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async submit() {
      try {
      await fetch("http://localhost:8000/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        credentials: "include",
        body: JSON.stringify({
          email: this.email,
          password: this.password,
        }),
      });
      await this.$router.push("/");
      } catch (error) {
        console.message(error);
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
