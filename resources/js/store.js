import { createStore } from 'vuex'
import axios from 'axios'

const store = createStore({
  state() {
    return {
      items: [],
    }
  },
  mutations: {
    setItems(state, items) {
      state.items = items
    },
    addItem(state, item) {
      state.items.push(item)
    },
    updateItem(state, updatedItem) {
      const index = state.items.findIndex((item) => item.id === updatedItem.id)
      if (index !== -1) {
        state.items[index] = updatedItem
      }
    },
    removeItem(state, itemId) {
      state.items = state.items.filter((item) => item.id !== itemId)
    },
  },
  actions: {
    async fetchItems({ commit }) {
      try {
        const response = await axios.get('api/items')
        commit('setItems', response.data)
      } catch (error) {
      }
    },
    async addItem({ commit }, formData) {
      try {
        const response = await axios.post('api/item/store', formData)
        if (response.status === 201) {
          commit('addItem', response.data)
        }
      } catch (error) {
        console.error('Error adding item:', error)
      }
    },
    async updateItem({ commit }, formData) {
      try {
        const response = await axios.put(
          `api/item/${formData.get('id')}`,
          formData,
        )
        if (response.status === 200) {
          commit('updateItem', response.data)
        }
      } catch (error) {
        console.error('Error updating item:', error)
      }
    },
    async removeItem({ commit }, itemId) {
      try {
        const response = await axios.delete(`api/item/${itemId}`)
        if (response.status === 200) {
          commit('removeItem', itemId)
        }
      } catch (error) {
        console.error('Error removing item:', error)
      }
    },
    async uploadFile({ commit }, formData) {
      try {
        const response = await axios.post('/api/upload', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
      } catch (error) {
        console.error('Error uploading file:', error)
        throw error
      }
    },
  },
  getters: {
    allItems(state) {
      return state.items
    },
  },
})

export default store
