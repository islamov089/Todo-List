<template>
  <div v-if="visible" class="modal-overlay">
    <div class="modal-content">
      <span class="close" @click="close">&times;</span>
      <h2>{{ modalTitle }}</h2>

      <el-form :model="item" label-width="120px">
        <el-form-item label="Task Name">
          <el-input v-model="item.name" placeholder="Enter item name" />
        </el-form-item>

        <el-form-item label="Status">
          <el-select v-model="item.status" placeholder="Select status">
            <el-option label="Pending" value="pending" />
            <el-option label="In Progress" value="in-progress" />
            <el-option label="Done" value="done" />
          </el-select>
        </el-form-item>

        <el-form-item label="Deadline">
          <el-date-picker v-model="item.deadline" type="date" placeholder="Select deadline" />
        </el-form-item>

        <el-form-item label="Attach a file">
          <el-upload
            action="#"
            :show-file-list="false"
            :auto-upload="false"
            :before-upload="beforeFileUpload"
            @change="onFileChange"
          >
            <el-button>Choose File</el-button>
          </el-upload>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" @click="confirm">Create/Update Task</el-button>
          <el-button @click="close">Cancel</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  props: {
    visible: Boolean,
    item: Object,
    modalTitle: String,
  },
  emits: ['close', 'reloadlist'], 
  data() {
    return {
      file: null,
    };
  },
  methods: {
    onFileChange(file) {
      this.file = file.raw;
    },
    
    beforeFileUpload(file) {
      this.file = file.raw;
      return false; 
    },

    close() {
      this.$emit('close');
    },

    async confirm() {
      if (!this.item.name || !this.item.deadline) {
        alert('Name and deadline are required for creating/updating tasks');
        return;
      }

      try {
        const formData = new FormData();
        formData.append('name', this.item.name);
        formData.append('status', this.item.status);
        formData.append('deadline', moment(this.item.deadline).format('YYYY-MM-DD'));


        if (this.file) {
          formData.append('file', this.file);
        }

        if (this.modalTitle === 'Add New Item') {
          await this.$store.dispatch('addItem', formData);
        } else {
          formData.append('id', this.item.id);
          await this.$store.dispatch('updateItem', formData);
        }

        this.close();
        this.$emit('reloadlist', this.item); 
      } catch (error) {
        console.error('Error saving task:', error);
        alert(`Failed to save item: ${error.response?.data?.message || error.message}`);
      }
    },
  },
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  position: relative;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
</style>
