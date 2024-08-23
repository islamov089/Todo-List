import { createApp } from 'vue';
import App from './vue/app.vue';
import '../css/app.css';
import i18n from './i18n'
import { library } from '@fortawesome/fontawesome-svg-core'; 
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons';

library.add(faPlusSquare, faTrash);

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);

app.use(i18n);
app.mount('#app');
