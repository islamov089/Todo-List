import { createRouter, createWebHistory } from 'vue-router';
import Login from '../vue/Login.vue';
import SignUp from '../vue/SignUp.vue';
import ToDoListPage from '../vue/ToDoList.vue'; 
import store from '../store'; 

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp,
  },
  {
    path: '/',
    name: 'ToDoListPage',
    component: ToDoListPage,
    meta: {
      requiresAuth: true, 
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters.isAuthenticated; 

  if (to.meta.requiresAuth && !isAuthenticated) {
   
    next({ name: 'Login' }); 
  } else {
    next(); 
  }
});

export default router;
