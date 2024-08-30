<template>
  <div class="data-table-container">
    <div class="search-container">
      <input 
        type="text" 
        v-model="searchQuery" 
        @input="filterData" 
        placeholder="Search..." 
        class="search-input"
      />
    </div>

    <DataTable :columns="columns" :rows="filteredData" :sortable="true" @sort="handleSort">
      <template v-slot:cell="{ column, row }">
        <span :class="getStatusClass(row[column.field])">{{ row[column.field] }}</span>
      </template>
      <template v-slot:actions='row'>
        <button class="btn btn-edit" @click="editItem(row.value.actions)">Edit</button>
        <button class="btn btn-delete" @click="deleteItem(row.value.actions.id)">Delete</button>
      </template>
    </DataTable>

    <div v-if="showEditPopup" class="edit-popup">
      <div class="popup-content">
        <h3>Edit Item</h3>
        <label>
          Name:
          <input v-model="editingItem.name" type="text" />
        </label>
        <label>
          Status:
          <select v-model="editingItem.status">
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="done">Done</option>
          </select>
        </label>
        <label>
          Deadline:
          <input v-model="editingItem.deadline" type="date" />
        </label>
        <button @click="updateItem">Save</button>
        <button @click="cancelEdit">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from '@bhplugin/vue3-datatable';
import { mapGetters, mapActions } from 'vuex';
import moment from 'moment';

export default {
  components: {
    DataTable
  },
  data() {
    return {
      searchQuery: '', 
      filteredData: [],
      showEditPopup: false,
      editingItem: {}
    };
  },
  computed: {
    ...mapGetters(['allItems']),
    tableData() {
      const data = this.allItems.map(item => ({
        id: item.id,
        name: item.name,
        status: this.formatStatus(item.status),
        deadline: this.formatDate(item.deadline),
        created_at: this.formatDate(item.created_at),
        actions: item
      }));
      return data;
    },
    columns() {
      return [
        { field: 'name', title: 'Name', width: "150px", sortable: true },
        { field: 'status', title: 'Status', width: "120px", sortable: true },
        { field: 'deadline', title: 'Deadline', type: "date", width: "150px", sortable: true },
        { field: 'created_at', title: 'Created At', type: "date", width: "150px", sortable: true },
        { field: 'actions', title: 'Actions', width: "150px" }
      ];
    }
  },
  methods: {
    ...mapActions(['updateItem', 'removeItem']),
    formatStatus(status) {
      switch (status) {
        case 'pending':
          return 'Pending';
        case 'in-progress':
          return 'In Progress';
        case 'done':
          return 'Done';
        default:
          return 'Unknown';
      }
    },
    formatDate(date) {
      return date ? moment(date).format('YYYY-MM-DD') : '';
    },
    getStatusClass(status) {
      switch (status) {
        case 'Pending':
          return 'status-pending';
        case 'In Progress':
          return 'status-in-progress';
        case 'Done':
          return 'status-done';
        default:
          return '';
      }
    },
    editItem(item) {
      this.editingItem = {
        id: item.id,
        name: item.name,
        status: item.status,
        deadline: this.formatDate(item.deadline)
      };
      this.showEditPopup = true;
    },
    async updateItem() {
      try {
        this.editingItem.deadline = moment(this.editingItem.deadline).format('YYYY-MM-DD');
        await this.$store.dispatch('updateItem', this.editingItem);
        this.showEditPopup = false;
        this.editingItem = {};
        this.filterData(); 
      } catch (error) {
        console.error('Error updating item:', error);
      }
    },
    async deleteItem(itemId) {
      try {
        await this.$store.dispatch('removeItem', itemId);
        console.log('Item deleted successfully');
      } catch (error) {
        console.error('Error deleting item:', error);
      }
    },
    handleSort({ field, direction }) {
      console.log('Sorting by', field, 'in', direction, 'direction');
    },
    filterData() {
      const query = this.searchQuery.toLowerCase();
      this.filteredData = this.tableData.filter(item => 
        Object.values(item).some(val => 
          typeof val === 'string' && val.toLowerCase().includes(query)
        )
      );
    },
    cancelEdit() {
      this.showEditPopup = false;
      this.editingItem = {}; 
    }
  },
  watch: {
    tableData(newData) {
      this.filterData();
    }
  },
  mounted() {
    this.filteredData = this.tableData; 
  }
};
</script>




<style scoped>
.data-table-container {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.search-container {
  margin-bottom: 20px;
}

.search-input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 100%;
  max-width: 300px;
}

.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  color: #fff;
  margin-right: 10px;
}

.btn-edit {
  background-color: #4CAF50; 
}

.btn-delete {
  background-color: #f44336; 
}

.status-pending {
  color: red;
}

.status-in-progress {
  color: yellow;
}

.status-done {
  color: green;
}

.v-data-table {
  border-collapse: collapse;
  width: 100%;
}

.v-data-table th, .v-data-table td {
  text-align: left;
  padding: 12px;
}

.v-data-table th {
  background-color: #f2f2f2;
}

.v-data-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.v-data-table tr:hover {
  background-color: #ddd;
}

.edit-popup {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background: #fff;
  padding: 20px;
  border-radius: 5px;
  max-width: 500px;
  width: 100%;
}
</style>
