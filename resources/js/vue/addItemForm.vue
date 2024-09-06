<template>
  <div>
    <button @click="showAddModal = true" class="addButton">Add Task</button>
    <modal
      :visible="showAddModal"
      :item="newItem"
      modalTitle="Add New Item"
      @close="handleClose"
      @reloadlist="$emit('reloadlist')"
    />
  </div>
</template>

<script>
  import Modal from './Modal.vue'
  import '../../scss/AddNewItemButton.scss'

  export default {
    components: {
      Modal,
    },
    data() {
      return {
        showAddModal: false,
        newItem: {
          name: '',
          status: 'pending',
          deadline: '',
        },
      }
    },

    methods: {
      handleClose() {
        this.showAddModal = false
        this.resetNewItem()
        this.$emit('reloadlist')
      },
      resetNewItem() {
        this.newItem = {
          name: '',
          status: 'pending',
          deadline: '',
        }
      },
    },
  }
</script>
