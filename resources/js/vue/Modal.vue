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

      <label for="file">Attach a file:</label>
      <input type="file" @change="onFileChange" />

      <button @click="uploadFile">Upload File</button>

      <button @click="confirm">Create/Update Task</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      visible: Boolean,
      item: Object,
      modalTitle: String,
    },
    data() {
      return {
        file: null, // Данные загружаемого файла
      }
    },
    methods: {
      // Обработка выбора файла
      onFileChange(event) {
        this.file = event.target.files[0]
      },

      // Метод для закрытия окна
      close() {
        this.$emit('close')
      },

      // Метод для загрузки файла
      async uploadFile() {
        if (!this.file) {
          alert('Please select a file to upload')
          return
        }

        const formData = new FormData()
        formData.append('file', this.file)

        try {
          await this.$store.dispatch('uploadFile', formData)
          alert('File uploaded successfully')
          this.close() // Закрытие модального окна после успешной загрузки
        } catch (error) {
          console.error('Error uploading file:', error)
          alert(
            `Failed to upload file: ${error.response?.data?.message || error.message}`,
          )
        }
      },

      // Метод для создания или обновления задачи
      async confirm() {
        if (!this.item.name || !this.item.deadline) {
          alert('Name and deadline are required for creating/updating tasks')
          return
        }

        try {
          const formData = new FormData()
          formData.append('name', this.item.name)
          formData.append('status', this.item.status)
          formData.append('deadline', this.item.deadline)

          if (this.modalTitle === 'Add New Item') {
            await this.$store.dispatch('addItem', formData)
          } else {
            formData.append('id', this.item.id)
            await this.$store.dispatch('updateItem', formData)
          }
          this.close()
          this.$emit('reloadlist')
        } catch (error) {
          console.error('Error saving task:', error)
          alert(
            `Failed to save item: ${error.response?.data?.message || error.message}`,
          )
        }
      },
    },
  }
</script>
