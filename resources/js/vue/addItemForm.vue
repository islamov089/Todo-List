<template>
  <el-button @click="showAddModal = true" class="addButton">
    {{ $t('addTask') }}
  </el-button>
  <el-button @click="exportItems" class="exportButton">
    {{ $t('exportTask') }}
  </el-button>
  <modal
    :visible="showAddModal"
    :item="newItem"
    :modalTitle="$t('modal.addTaskTitle')"
    @close="handleClose"
    @reloadlist="handleReloadList"
  />
</template>

<script>
  import Modal from './Modal.vue'
  import { ElButton } from 'element-plus'
  import { defineComponent, ref } from 'vue'
  import { useStore } from 'vuex'

  export default defineComponent({
    components: {
      Modal,
      ElButton,
    },
    setup() {
      const store = useStore()
      const showAddModal = ref(false)
      const newItem = ref({
        name: '',
        status: 'pending',
        deadline: '',
      })

      const handleReloadList = (newData) => {
        showAddModal.value = false
      }

      const handleClose = () => {
        showAddModal.value = false
      }

      const exportItems = () => {
      store.dispatch('exportItems')
      .then(() => {
      console.log('Items exported successfully')
    })
      .catch(error => {
      console.error('Error during export:', error)  
      alert(`Failed to export items: ${error.message || 'Unknown error'}`)  
    })
}


      return {
        showAddModal,
        newItem,
        handleReloadList,
        handleClose,
        exportItems,
      }
    },
  })
</script>
