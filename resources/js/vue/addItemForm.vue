<template>
  <div>
    <el-button @click="showAddModal = true" class="addButton">Add task</el-button>
    <el-button @click="exportItems" class="exportButton">Export task</el-button>
    <modal
      :visible="showAddModal"
      :item="newItem"
      modalTitle="Добавить новую задачу"
      @close="handleClose"
      @reloadlist="handleReloadList"
    />
  </div>
</template>

<script>
import Modal from './Modal.vue';
import { ElButton } from 'element-plus';
import { defineComponent, ref } from 'vue';
import { useStore } from 'vuex';

export default defineComponent({
  components: {
    Modal,
    ElButton,
  },
  setup() {
    const store = useStore();
    const showAddModal = ref(false);
    const newItem = ref({
      name: '',
      status: 'pending',
      deadline: '',
    });

    const handleReloadList = (newData) => {
      showAddModal.value = false;
    };

    const handleClose = () => {
      showAddModal.value = false;
    };

    const exportItems = async () => {
      try {
        await store.dispatch('exportItems');
      } catch (error) {
      }
    };

    return {
      showAddModal,
      newItem,
      handleReloadList,
      handleClose,
      exportItems,
    };
  },
});
</script>
