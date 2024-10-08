<template>
  <div class="data-table-container">
    <div class="search-container">
      <el-input
        v-model="searchQuery"
        @input="filterData"
        placeholder="Search..."
        class="search-input"
      />
    </div>

    <DataTable
      :columns="columns"
      :rows="filteredData"
      :sortable="true"
      @sort="handleSort"
    >
      <template v-slot:cell="{ column, row }">
        <span :class="getStatusClass(row[column.field])">
          {{ row[column.field] }}
        </span>
      </template>
      <template v-slot:actions="row">
        <el-button type="primary" @click="editItem(row.value.actions)">
          Edit
        </el-button>
        <el-button type="danger" @click="deleteItem(row.value.actions.id)">
          Delete
        </el-button>
      </template>
    </DataTable>

    <div v-if="showEditPopup" class="edit-popup">
      <el-card class="popup-content">
        <h3>Edit Item</h3>
        <el-form :model="editingItem" label-position="top">
          <el-form-item label="Name">
            <el-input v-model="editingItem.name" />
          </el-form-item>
          <el-form-item label="Status">
            <el-select v-model="editingItem.status">
              <el-option value="pending" label="Pending" />
              <el-option value="in-progress" label="In Progress" />
              <el-option value="done" label="Done" />
            </el-select>
          </el-form-item>
          <el-form-item label="Deadline">
            <el-date-picker
              v-model="editingItem.deadline"
              type="date"
              format="yyyy-MM-dd"
              value-format="yyyy-MM-dd"
            />
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="updateItem">Save</el-button>
            <el-button @click="cancelEdit">Cancel</el-button>
          </el-form-item>
        </el-form>
      </el-card>
    </div>
  </div>
</template>

<script>
  import DataTable from '@bhplugin/vue3-datatable'
  import { mapGetters, mapActions } from 'vuex'
  import moment from 'moment'
  import 'element-plus/dist/index.css'

  export default {
    components: {
      DataTable,
    },
    data() {
      return {
        searchQuery: '',
        filteredData: [],
        showEditPopup: false,
        editingItem: {},
      }
    },
    computed: {
      ...mapGetters(['allItems']),
      tableData() {
        const data = this.allItems.map((item) => ({
          id: item.id,
          name: item.name,
          status: this.formatStatus(item.status),
          deadline: this.formatDate(item.deadline),
          created_at: this.formatDate(item.created_at),
          actions: item,
        }))
        return data
      },
      columns() {
        return [
          { field: 'name', title: 'Name', width: '150px', sortable: true },
          { field: 'status', title: 'Status', width: '120px', sortable: true },
          {
            field: 'deadline',
            title: 'Deadline',
            type: 'date',
            width: '150px',
            sortable: true,
          },
          {
            field: 'created_at',
            title: 'Created At',
            type: 'date',
            width: '150px',
            sortable: true,
          },
          { field: 'actions', title: 'Actions', width: '150px' },
        ]
      },
    },
    methods: {
      ...mapActions(['updateItem', 'removeItem']),
      formatStatus(status) {
        switch (status) {
          case 'pending':
            return 'Pending'
          case 'in-progress':
            return 'In Progress'
          case 'done':
            return 'Done'
          default:
            return 'Unknown'
        }
      },
      formatDate(date) {
        return date ? moment(date).format('YYYY-MM-DD') : ''
      },
      getStatusClass(status) {
        switch (status) {
          case 'Pending':
            return 'status-pending'
          case 'In Progress':
            return 'status-in-progress'
          case 'Done':
            return 'status-done'
          default:
            return ''
        }
      },
      editItem(item) {
        this.editingItem = {
          id: item.id,
          name: item.name,
          status: item.status,
          deadline: this.formatDate(item.deadline),
        }
        this.showEditPopup = true
      },
      async updateItem() {
        try {
          this.editingItem.deadline = moment(this.editingItem.deadline).format(
            'YYYY-MM-DD',
          )
          await this.$store.dispatch('updateItem', this.editingItem)
          this.showEditPopup = false
          this.editingItem = {}
          this.filterData()
        } catch (error) {
          console.error('Error updating item:', error)
        }
      },
      async deleteItem(itemId) {
        try {
          await this.$store.dispatch('removeItem', itemId)
        } catch (error) {
          console.error('Error deleting item:', error)
        }
      },
      handleSort({ field, direction }) {},
      filterData() {
        const query = this.searchQuery.toLowerCase()
        this.filteredData = this.tableData.filter((item) =>
          Object.values(item).some(
            (val) =>
              typeof val === 'string' && val.toLowerCase().includes(query),
          ),
        )
      },
      cancelEdit() {
        this.showEditPopup = false
        this.editingItem = {}
      },
    },
    watch: {
      tableData(newData) {
        this.filterData()
      },
    },
    mounted() {
      this.filteredData = this.tableData
    },
  }
</script>
