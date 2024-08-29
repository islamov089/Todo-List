<template>
  <div class="todoListContainer">
    <div class="heading">
      <h2 id="title">{{ $t('title') }}</h2> 
      <add-item-form v-on:reloadlist="getList" />
    </div>
    <list-view :items="items" v-on:reloadlist="getList" />
  </div>
</template>

<script>
import addItemForm from './addItemForm.vue';
import listView from './listView.vue';

export default {
  components: {
    addItemForm,
    listView
  },
  computed: {
    items() {
      return this.$store.getters.allItems;
    }
  },
  methods: {
    async getList() {
      await this.$store.dispatch('fetchItems');
    }
  },
  created() {
    this.getList();
  }
};
</script>

<style scoped>
.todoListContainer {
  width: 800px;
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
