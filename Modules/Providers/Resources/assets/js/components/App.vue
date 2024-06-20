<template>
    <div class="container">
     
      <header-component></header-component>
   
      <router-view></router-view>
      <!-- <footer-component></footer-component>        -->
    </div>
  </template>
  
  <script>
  import HeaderComponent from './layout/header.vue';
  import FooterComponent from './layout/footer.vue';
  import LoginComponent from './pages/LoginComponent.vue';
  
  export default {
    components: {
      HeaderComponent,
      FooterComponent,
      LoginComponent
    }
  }
  </script>
  