import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const gameStore = new Vuex.Store({
  state: {
    currentId: null,
    opponentId: null,
    pieces: [
      {
        x: 4,
        y: 4,
        color: 'white'
      },
      {
        x: 5,
        y: 4,
        color: 'black'
      },
      {
        x: 4,
        y: 5,
        color: 'black'
      },
      {
        x: 5,
        y: 5,
        color: 'white'
      }
    ]
  },
  getters: {
    getCurrentId: state => state.currentId,
    getPieces: state => state.pieces
  },
  mutations: {
    setCurrentId (state, id) { state.currentId = id }
  }
})

export default gameStore
