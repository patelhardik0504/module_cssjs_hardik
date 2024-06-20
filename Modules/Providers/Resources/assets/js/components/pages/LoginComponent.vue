
<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Login</div>
          <div v-if="errorMessage" class="help-block">{{ errorMessage }}</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" @submit.prevent="submitForm">
              <div class="form-group" :class="{'has-error': errors.email}">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" v-model="formData.email">
                  <span v-if="errors.email" class="help-block">
                    <strong>{{ errors.email[0] }}</strong>
                  </span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.password}">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" v-model="formData.password">
                  <span v-if="errors.password" class="help-block">
                    <strong>{{ errors.password[0] }}</strong>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Login
                  </button>
                  <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                </div>
              </div>
            </form>
            <div class="form-group">
              <router-link to="/providers" class="nav-item nav-link">Home</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'; 


export default {
  data() {
    return {
      LoginRoute: '/provider-login',
      formData: {
        email: '',
        password: ''
      },
      errors: {},
      errorMessage: ''
    };
  },
  methods: {
    async submitForm() {
      try {
       
        const response = await axios.post(this.LoginRoute, this.formData, {
          headers: {
            'X-CSRF-TOKEN': window.csrfToken
          }
        });
        
        const { data } = response;
        if (data.success) {

          this.$router.push({ name: 'Dashboard' });

          // window.location.href = window.redirectUrl; 
        } else {
          this.errorMessage = data.error;
          this.errors = {}; 
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errorMessage =  '';
          this.errors = error.response.data.errors;
        } else {
          console.log(error);
          this.errorMessage = 'An unexpected error occurred.';
          this.errors = {}; 
          console.error('Error occurred:', error.response.data);
        }
      }
    }
  }
}
</script>



