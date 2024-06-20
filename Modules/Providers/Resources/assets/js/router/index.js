// In your router/index.js or wherever you define your routes
import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/pages/DashboardComponent.vue';
import Login from '../components/pages/LoginComponent.vue';
import home from '../components/pages/CommonComponet.vue';
import RegisterComponent from '../components/pages/RegisterComponent.vue';



const routes = [
  {
    path: '/providers/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/providers/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/providers',
    name: '/',
    component: home
  },
  {
    path: '/providers/register',
    name: 'Register',
    component: RegisterComponent
  }
  
  // Other routes...
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
