<template>
  <main class="login-form">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form @submit.prevent="register">
              
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                  <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name" v-model="form.name"  autofocus>
                    <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                  <div class="col-md-6">
                    <input type="email" id="email_address" class="form-control" name="email" v-model="form.email" >
                    <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                  <div class="col-md-6">
                    <input type="password" id="password" class="form-control" name="password" v-model="form.password" >
                    <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" v-model="form.remember"> Remember Me
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      registerRoute: window.posturl,
      form: {
        name: '',
        email: '',
        password: '',
        remember: false
      },
      errors: {}
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post(this.registerRoute, this.form, {
          headers: {
            'X-CSRF-TOKEN': window.csrfToken
          }
        });
        if (response.data.success) {
          window.location.href = window.redirectUrl; // Redirect to login page
        } else {
          this.errors = response.data.errors || {};
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        }
      }
    }
  }
}
</script>


