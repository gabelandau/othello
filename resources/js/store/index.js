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
    setCurrentId (state, id) { state.currentId = id },
    setBoard (state, data) { state.pieces = data.board },
    addPiece (state, data) {
      Vue.set(state.pieces, `${data.x}${data.y}`, { x: data.x, y: data.y, color: data.color })

      for (let x in data.changedPieces) {
        Vue.set(state.pieces, x, { x: data.changedPieces[x].x, y: data.changedPieces[x].y, color: data.changedPieces[x].color })
      }
    }
  }
})

export default gameStore
