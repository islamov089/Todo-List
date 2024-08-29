import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state() {
    return {
      items: [] 
    };
  },
  mutations: {
    setItems(state, items) {
      console.log('Setting items:', items); 
      state.items = items; 
    },
    addItem(state, item) {
      console.log('Adding item:', item); 
      state.items.push(item); 
    },
    updateItem(state, updatedItem) {
      console.log('Updating item:', updatedItem); 
      const index = state.items.findIndex(item => item.id === updatedItem.id);
      if (index !== -1) {
        state.items[index] = updatedItem; 
      }
    },
    removeItem(state, itemId) {
      console.log('Removing item with ID:', itemId); 
      state.items = state.items.filter(item => item.id !== itemId); 
    }
  },
  actions: {
    async fetchItems({ commit }) {
      try {
        const response = await axios.get('api/items');
        console.log('Fetched items:', response.data); 
        commit('setItems', response.data); 
      } catch (error) {
        console.error('Error fetching items:', error); 
      }
    },
    async addItem({ commit }, item) {
      try {
        const response = await axios.post('api/item/store', item);
        if (response.status === 201) {
          commit('addItem', response.data); 
        }
      } catch (error) {
        console.error('Error adding item:', error); 
      }
    },
    async updateItem({ commit }, item) {
      try {
        const response = await axios.put(`api/item/${item.id}`, item);
        if (response.status === 200) {
          commit('updateItem', response.data); 
        }
      } catch (error) {
        console.error('Error updating item:', error); 
      }
    },
    async removeItem({ commit }, itemId) {
      try {
        const response = await axios.delete(`api/item/${itemId}`);
        if (response.status === 200) {
          commit('removeItem', itemId); 
        }
      } catch (error) {
        console.error('Error removing item:', error); 
      }
    }
  },
  getters: {
    allItems(state) {
      return state.items; 
    }
  }
});

export default store;
