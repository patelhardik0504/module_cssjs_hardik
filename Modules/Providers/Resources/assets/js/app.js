

// Import Vue and necessary plugins
import { createApp } from 'vue'; // Import createApp from 'vue' for Vue 3
import VueAxios from 'vue-axios';
import axios from 'axios';

// Import other components and routes
import  routes  from './router/index';
import App from './components/App.vue';

// Create Vue app instance
const app = createApp(App);

// Use Vue plugins
app.use(VueAxios, axios);


// Integrate router with the app instance
app.use(routes);

// Mount the app to a DOM element
app.mount('#app');
