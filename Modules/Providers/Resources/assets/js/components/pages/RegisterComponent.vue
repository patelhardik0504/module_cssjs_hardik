<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div v-if="errorMessage" class="help-block">{{ errorMessage }}</div>
        <div v-if="!otpVerified" class="panel panel-default">
          <div class="panel-heading">Register</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" @submit.prevent="register">
              <!-- Registration form fields -->
              <!-- First name -->
              <div class="form-group" :class="{'has-error': errors.first_name}">
                <label class="col-md-4 control-label">First name</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" v-model="formData.first_name" placeholder="First Name">
                  <span v-if="errors.first_name" class="help-block">
                    <strong>{{ errors.first_name[0] }}</strong>
                  </span>
                </div>
              </div>
              <!-- Last name -->
              <div class="form-group" :class="{'has-error': errors.last_name}">
                <label class="col-md-4 control-label">Last name</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" v-model="formData.last_name" placeholder="Last Name">
                  <span v-if="errors.last_name" class="help-block">
                    <strong>{{ errors.last_name[0] }}</strong>
                  </span>
                </div>
              </div>
              <!-- Email -->
              <div class="form-group" :class="{'has-error': errors.email}">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" v-model="formData.email" placeholder="Email Address">
                  <span v-if="errors.email" class="help-block">
                    <strong>{{ errors.email[0] }}</strong>
                  </span>
                </div>
              </div>
              <!-- Password -->
              <div class="form-group" :class="{'has-error': errors.password}">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" v-model="formData.password" placeholder="Password">
                  <span v-if="errors.password" class="help-block">
                    <strong>{{ errors.password[0] }}</strong>
                  </span>
                </div>
              </div>
              <!-- Confirm Password -->
              <div class="form-group" :class="{'has-error': errors.confirmPassword}">
                <label class="col-md-4 control-label">Confirm Password</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" v-model="formData.confirmPassword" placeholder="Confirm Password">
                  <span v-if="errors.confirmPassword" class="help-block">
                    <strong>{{ errors.confirmPassword[0] }}</strong>
                  </span>
                </div>
              </div>
              <!-- Submit button -->
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Register
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div v-if="otpVerified" class="panel panel-default">
          <div class="panel-heading">Verify OTP</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" @submit.prevent="verifyOTP">
              <!-- OTP input field -->
              <div class="form-group" :class="{'has-error': otpError}">
                <label class="col-md-4 control-label">OTP</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" v-model="otp" placeholder="Enter OTP">
                  <span v-if="otpError" class="help-block">
                    <strong>{{ otpError }}</strong>
                  </span>
                </div>
              </div>
              <!-- Submit button -->
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Verify OTP
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="form-group">
              <router-link to="/providers" class="nav-item nav-link">Home</router-link>
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
      RegisterRoute: '/provider-register',
      VerifyRoute: window.VerifyOTPUrl,
      formData: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        confirmPassword: ''
      },
      errors: {},
      otp: '',
      otpError: '',
      otpVerified: false,
      errorMessage: ''
    };
  },
  methods: {
    async register() {
      try {
        console.log(this.RegisterRoute);
        
        const response = await axios.post(this.RegisterRoute, this.formData, {
          headers: {
            'X-CSRF-TOKEN': window.csrfToken
          }
        });

        const { data } = response;
             
        if (data.user && data.otp && data.redirect) {
          // Registration successful, move to OTP verification
          console.log(data); 
          this.otpVerified = true;
          this.otpError = '';
          // Redirect URL can be used to navigate to the OTP verification step
          // this.$router.push(data.redirect);
        }
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else {
          console.log(error);
          console.error('Error occurred:', error.response.data);
        }
      }
    },
    async verifyOTP() {
      try {
        const response = await axios.post('/verify-otp', { user_id: this.formData.email, otp: this.otp }, {
          headers: {
            'X-CSRF-TOKEN': window.csrfToken
          }
        });

          this.otpVerified = true;
          const { data } = response;
          if(data.success)
          {
            this.$router.push({name:"Login"})
          }
          else {
            this.errorMessage = data.error;
            this.errors = {}; 
          }
      } catch (error) {
        console.log(error.response);
        if (error.response && error.response.status === 422) {
          this.otpError =  error.response.data.errors;
        } else {
          console.error('Error occurred:', error.response.data);
        }
      }
    }
  }
}
</script>
