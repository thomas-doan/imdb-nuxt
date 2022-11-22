<template>
<main class="form-signin">
  <form @submit.prevent="submit">
    <h1 class="h3 mb-3 fw-normal">Enregistez-vous</h1>

    <input v-model="name" class="form-control" placeholder="Pseudo" required>

    <input v-model="email" type="email" class="form-control" placeholder="Email" required>

    <input v-model="password" type="password" class="form-control" placeholder="Password" required>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Envoyé</button>
  </form>
  </main>  
</template>

<script>
export default {
  name: "register",
  data() {
    return {
      name: '',
      email: '',
      password: ''
    }
  },
  methods: {
    async submit() {
      await fetch('http://localhost:8000/api/register', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          name: this.name,
          email: this.email,
          password: this.password
        })
      });
      await this.$router.push('/login');
    }
  }
}
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
