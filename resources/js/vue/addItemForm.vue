<template>
  <div>
    <button @click="showAddModal = true">
      Add Task
    </button>

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
import Modal from './Modal.vue';

export default {
  components: {
    Modal
  },
  data() {
    return {
      showAddModal: false,
      newItem: {
        name: '',
        status: 'pending',
        deadline: ''
      }
    };
  },
  methods: {
    handleClose() {
      this.showAddModal = false;
      this.resetNewItem();
      this.$emit('reloadlist'); 
    },
    resetNewItem() {
      this.newItem = {
        name: '',
        status: 'pending',
        deadline: ''
      };
    }
  }
};
</script>

<style scoped>
button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
}
</style>
