import { createStore } from 'vuex'
import axios from 'axios'
import { saveAs } from 'file-saver'

const store = createStore({
  state() {
    return {
      items: [],
      isAuthenticated: false, 
      user: null, 
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
    setUser(state, user) {
      state.user = user
      state.isAuthenticated = true 
    },
    logout(state) {
      state.user = null
      state.isAuthenticated = false 
    },
  },

  actions: {
    async fetchItems({ commit }) {
      try {
        const response = await axios.get('api/items')
        commit('setItems', response.data)
      } catch (error) {
        console.error('Error fetching items:', error)
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

    async updateItem({ commit }, itemData) {
      try {
        const response = await axios.put(`api/item/${itemData.id}`, itemData)
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

    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/api/login', credentials)
        if (response.status === 200) {
          commit('setUser', response.data.user) 
        }
      } catch (error) {
        console.error('Error logging in:', error)
      }
    },

    async logout({ commit }) {
      try {
        await axios.post('/api/logout')
        commit('logout') 
      } catch (error) {
        console.error('Error logging out:', error)
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

    async exportItems() {
      try {
        const response = await axios.get('/api/export', { responseType: 'blob' })
        saveAs(new Blob([response.data]), 'items.xlsx')
      } catch (error) {
        console.error('Error exporting items:', error)
      }
    }
  },
  getters: {
    allItems(state) {
      return state.items
    },
    isAuthenticated(state) {
      return state.isAuthenticated
    },
    currentUser(state) {
      return state.user
    },
  },
})

export default store
