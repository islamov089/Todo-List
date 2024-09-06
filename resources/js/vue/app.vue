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
  import addItemForm from './addItemForm.vue'
  import listView from './listView.vue'
  import '../../scss/ToDoListComponents.scss'

  export default {
    components: {
      addItemForm,
      listView,
    },
    computed: {
      items() {
        return this.$store.getters.allItems
      },
    },
    methods: {
      async getList() {
        await this.$store.dispatch('fetchItems')
      },
    },
    created() {
      this.getList()
    },
  }
</script>
