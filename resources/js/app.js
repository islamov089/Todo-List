import { createApp } from 'vue';
import App from './vue/app.vue';
import '../css/app.css';

import { library } from '@fortawesome/fontawesome-svg-core'; 
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons';

library.add(faPlusSquare, faTrash);

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);


app.mount('#app');
