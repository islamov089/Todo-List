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
      <template v-slot:actions="{ row }">
        <button class="btn btn-edit" @click="editItem(row)">Edit</button>
        <button class="btn btn-delete" @click="deleteItem(row.id)">Delete</button>
      </template>
    </DataTable>
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
      filteredData: [] 
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
      }));
      console.log('Formatted table data:', data); 
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
      return moment(date).format('DD-MM-YYYY');
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
      console.log('Editing item:', item);
    },
    deleteItem(itemId) {
      console.log('Deleting item with id:', itemId);
      this.removeItem(itemId);
    },
    handleSort({ field, direction }) {
      console.log('Sorting by', field, 'in', direction, 'direction');    },
    filterData() {
      const query = this.searchQuery.toLowerCase();
      this.filteredData = this.tableData.filter(item => 
        Object.values(item).some(val => 
          typeof val === 'string' && val.toLowerCase().includes(query)
        )
      );
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
</style>
