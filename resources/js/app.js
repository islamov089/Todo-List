import { createApp } from 'vue';
import App from './vue/app.vue';
import '../scss/app.scss';
import i18n from './i18n';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { 
  faPlusSquare, 
  faTrash, 
  faEdit 
} from '@fortawesome/free-solid-svg-icons';
import store from './store';
import DataTable from '@bhplugin/vue3-datatable';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';

library.add(faPlusSquare, faTrash, faEdit);

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
app.component('DataTable', DataTable);

app.use(store);
app.use(i18n);
app.use(ElementPlus);

app.mount('#app');
