<template>
    <div>
      <h1>Hello World</h1>
  
      <p>
        This view is loaded from module: {{ user }}
        
      </p>
      <p>Hye</p>

      <p>User Email: {{ user.email }}</p> <!-- Displaying the user's email -->
  
      <form @submit.prevent="logout">
        <button type="submit">Logout</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios'; 


export default {
  props: {
    user: Object // Define the user prop
  },
  mounted() {
    console.log('User prop:', this.user);
  },
  data() {
    return {
      LogoutRoute: '/providers/logout',
      errors: {},
      errorMessage: ''
    };
  },
  methods: {
    async logout() {
      try {
       
        const response = await axios.post(this.LogoutRoute,{
          headers: {
            'X-CSRF-TOKEN': window.csrfToken
          }
        });        
        const { data } = response;
        if (data.success) {
          this.$router.push({ name: 'Login' });
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
  },
  
}
  </script>
  