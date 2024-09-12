<template>
  <el-button @click="showAddModal = true" class="addButton">Add Task</el-button>
  <modal
    :visible="showAddModal"
    :item="newItem"
    modalTitle="Add New Item"
    @close="handleClose"
    @reloadlist="handleReloadList"
  />
</template>

<script>
import Modal from './Modal.vue';
import { ElButton } from 'element-plus';
import { defineComponent, ref } from 'vue';


export default defineComponent({
  components: {
    Modal,
    ElButton,
  },
  setup() {
    const showAddModal = ref(false);
    const newItem = ref({
      name: '',
      status: 'pending',
      deadline: '',
    });

    const handleReloadList = (newData) => {
      console.log('New task data:', newData);
      showAddModal.value = false;
    };

    const handleClose = () => {
      showAddModal.value = false;
    };

    return {
      showAddModal,
      newItem,
      handleReloadList,
      handleClose,
    };
  },
});
</script>


