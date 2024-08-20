<template>
  <div class="item">
    <input  
      type="checkbox"
      @change="updateCheck"
      v-model="item.completed"
    />
    <span :class="[item.completed ? 'completed' : '', 'itemText']">
      {{ item.name }}
    </span>
    <button @click="removeItem" class="trashItem">
      <font-awesome-icon icon="trash"/>
    </button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['item'],
  methods: {
    async updateCheck() {
      try {
        const response = await axios.put(`api/item/${this.item.id}`, {
          item: this.item
        });
        if (response.status === 200) {
          this.$emit('itemchanged');
        }
      } catch (error) {
        console.error(error);
      }
    },
    async removeItem() {
      try {
        const response = await axios.delete(`api/item/${this.item.id}`);
        if (response.status === 200) {
          this.$emit('itemchanged');
        }
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<style scoped>
.completed {
  text-decoration: line-through;
  color: #999999;
}

.itemText {
  width: 100%;
  margin-left: 20px;
}

.item {
  display: flex;
  justify-content: center;
  align-items: center;
}

.trashItem {
  background: #e6e6e6;
  border: none;
  color: #ff0000;
  outline: none;
  cursor: pointer;
}
</style>
