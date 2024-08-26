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
export default {
  props: ['item'],
  methods: {
    async updateCheck() {
      await this.$store.dispatch('updateItem', this.item)
      this.$emit('itemchanged')
    },
    async removeItem() {
      await this.$store.dispatch('removeItem', this.item.id)
      this.$emit('itemchanged')
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
