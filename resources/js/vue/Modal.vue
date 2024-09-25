<template>
  <div v-if="visible" class="modal-overlay">
    <div class="modal-content">
      <span class="close" @click="close">&times;</span>
      <h2>{{ modalTitle }}</h2>

      <el-form :model="item" label-width="120px">
        <el-form-item :label="$t('taskName')">
          <el-input v-model="item.name" :placeholder="$t('enterItemName')" />
        </el-form-item>

        <el-form-item :label="$t('status')">
  <el-select v-model="item.status" :placeholder="$t('selectStatus')">
    <el-option :label="$t('statusDraft')" value="draft" />
    <el-option :label="$t('statusPending')" value="pending" />
    <el-option :label="$t('statusInProgress')" value="in-progress" />
    <el-option :label="$t('statusDone')" value="done" />
  </el-select>
</el-form-item>


        <el-form-item :label="$t('deadline')">
          <el-date-picker
            v-model="item.deadline"
            type="date"
            :placeholder="$t('selectDeadline')"
          />
        </el-form-item>

        <el-form-item :label="$t('attachFile')">
          <el-upload
            action="#"
            :show-file-list="false"
            :auto-upload="false"
            :before-upload="beforeFileUpload"
            @change="onFileChange"
          >
            <el-button>{{ $t('chooseFile') }}</el-button>
          </el-upload>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" @click="confirm">
            {{ $t('createUpdateTask') }}
          </el-button>
          <el-button @click="close">{{ $t('cancel') }}</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import moment from 'moment'

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
    }
  },
  methods: {
    onFileChange(file) {
      this.file = file.raw
    },

    beforeFileUpload(file) {
      this.file = file.raw
      return false
    },

    close() {
      this.$emit('close')
    },

    async confirm() {
      if (!this.item.name || !this.item.deadline) {
        alert(this.$t('nameAndDeadlineRequired'))
        return
      }

      try {
        const formData = new FormData()
        formData.append('name', this.item.name)
        formData.append('status', this.item.status)
        formData.append('deadline', moment(this.item.deadline).format('YYYY-MM-DD'))

        if (this.file) {
          formData.append('file', this.file)
        }

        if (this.modalTitle === this.$t('addNewItem')) {
          await this.$store.dispatch('addItem', formData)
        } else {
          formData.append('id', this.item.id)
          await this.$store.dispatch('updateItem', formData)
        }

        this.close()
        this.$emit('reloadlist', this.item)
      } catch (error) {
        console.error(this.$t('savingTaskError'), error)
        alert(
          this.$t('failedToSaveItem', {
            message: error.response?.data?.message || error.message,
          })
        )
      }
    },
  },
}

</script>


