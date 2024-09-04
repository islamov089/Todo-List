<template>
  <div v-if="visible" class="modal-overlay">
    <div class="modal-content">
      <span class="close" @click="close">&times;</span>
      <h2>{{ modalTitle }}</h2>
      <input type="text" v-model="item.name" placeholder="Enter item name" />

      <label for="status">Status:</label>
      <select id="status" v-model="item.status">
        <option value="pending">Pending</option>
        <option value="in-progress">In Progress</option>
        <option value="done">Done</option>
      </select>

      <label for="deadline">Deadline:</label>
      <input type="date" id="deadline" v-model="item.deadline" />

      <button @click="confirm">Create Task</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    visible: Boolean,
    item: Object,
    modalTitle: String
  },
  methods: {
    close() {
      this.$emit('close');
    },
    async confirm() {
      if (!this.item.name || !this.item.deadline) {
        alert('Name and deadline are required');
        return;
      }

      try {
        if (this.modalTitle === 'Add New Item') {
          await this.$store.dispatch('addItem', this.item);
        } else {
          await this.$store.dispatch('updateItem', this.item);
        }
        this.close();
        this.$emit('reloadlist');
      } catch (error) {
        console.error('Error confirming item changes:', error);
        alert(`Failed to save item: ${error.response?.data?.message || error.message}`);
      }
    }
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: white;
  padding: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  position: relative;
  width: 80%;
  max-width: 500px;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 20px;
}

label {
  margin-top: 10px;
  display: block;
}

input[type="date"] {
  margin-top: 5px;
  padding: 5px;
  width: 100%;
}
</style>
