<template>
  <div>
    <button @click="showAddModal = true" class="addButton">Add Task</button>
    <modal
      :visible="showAddModal"
      :item="newItem"
      modalTitle="Add New Item"
      @close="handleClose"
      @reloadlist="$emit('reloadlist')"
    >
      <template v-slot:body>
        <form @submit="onSubmit">
          <div>
            <label for="name">Task Name</label>
            <input v-model="newItem.name" name="name" type="text" />
            <span v-if="errors.name">{{ errors.name }}</span>
          </div>
          <div>
            <label for="status">Status</label>
            <input v-model="newItem.status" name="status" type="text" />
            <span v-if="errors.status">{{ errors.status }}</span>
          </div>
          <div>
            <label for="deadline">Deadline</label>
            <input v-model="newItem.deadline" name="deadline" type="date" />
            <span v-if="errors.deadline">{{ errors.deadline }}</span>
          </div>
          <button type="submit">Save</button>
        </form>
      </template>
    </modal>
  </div>
</template>

<script>
import Modal from './Modal.vue'
import '../../scss/AddNewItemButton.scss'
import { useForm, useField } from 'vee-validate';
import * as yup from 'yup';

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
  setup() {
    const { handleSubmit, errors } = useForm({
      validationSchema: yup.object({
        name: yup.string().required('Task name is required').min(3, 'Task name must be at least 3 characters'),
        status: yup.string().required('Status is required'),
        deadline: yup.date().required('Deadline is required').min(new Date(), 'Deadline must be in the future'),
      }),
    });

    const { value: name } = useField('name');
    const { value: status } = useField('status');
    const { value: deadline } = useField('deadline');

    const onSubmit = handleSubmit((values) => {
    });

    return {
      name,
      status,
      deadline,
      errors,
      onSubmit,
    };
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
