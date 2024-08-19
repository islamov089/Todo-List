<template>
    <div class="todoListContainer">
      <div class="heading">
        <h2 id="title">Todo List</h2>
        <add-item-form />
      </div>
      <list-view 
      :items="items" 
      v-on:reloadlist="getList()"
      />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
import addItemForm from './addItemForm.vue';
  import listView from './listView.vue';
import { error } from 'laravel-mix/src/Log';
  
  export default {
    components: {
      addItemForm,
      listView
    },
data:function(){
  return{
    items:[]
  }
},
methods:{
  getList(){
    axios.get('api/items')
    .then(response=>{
      this.items = response.data
    })
    .catch(error=>{
      console.log(error)
    })
  }
},
created(){
  this.getList();
}


  };
  </script>
  
  <style scoped>
  .todoListContainer {
    width: 550px;
    margin: auto;
    background: #f5f5f5; 
    border-radius: 10px; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .heading {
    background: linear-gradient(135deg, #74ebd5, #9face6); 
    padding: 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  
  #title {
    text-align: center;
    font-family: 'Roboto', sans-serif;
    color: #f5f5f5;
    letter-spacing: 2px; 
    text-transform: uppercase; 
    background-color: #5c6bc0; 
    border-radius: 8px; 
}


  </style>
  