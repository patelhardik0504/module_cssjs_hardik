import './bootstrap';

import { createApp } from 'vue';
import ComponentA from './components/ComponentA.vue';
import ComponentB from './components/LoginComponet.vue';

const app = createApp({});

app.component('ComponentA', ComponentA);
app.component('ComponentB', ComponentB);

app.mount("#app");