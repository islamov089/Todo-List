<template>
  <div class="addItem">
    <input type="text" v-model="item.name" />
    <font-awesome-icon
      icon="plus-square"
      @click="addItem"
      :class="[item.name ? 'active' : 'inactive', 'plus']"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: {
        name: '',
      },
    };
  },
  methods: {
    async addItem() {
      if (this.item.name === '') {
        return;
      }
      await this.$store.dispatch('addItem', this.item)
      this.item.name = ''
      this.$emit('reloadlist')
    },
  },
};
</script>


<style scoped>
.addItem {
  display: flex;
  justify-content: center;
  align-items: center;
}

input {
  background: #f7f7f7;
  border: 0;
  outline: none;
  padding: 5px;
  margin-right: 10px;
  width: 100%;
}

.plus {
  font-size: 20px;
}

.active {
  color: #00ce25;
}

.inactive {
  color: #999999;
}
</style>
