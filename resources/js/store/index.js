import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const gameStore = new Vuex.Store({
  state: {
    currentId: null,
    opponentId: null,
    gameId: null,
    color: null,
    currentTurn: null,
    win: null,
    pieces: {}
  },
  getters: {
    getCurrentId: state => state.currentId,
    getPieces: state => state.pieces,
    getGameId: state => state.gameId,
    getColor: state => state.color,
    getCurrentTurn: state => state.currentTurn,
    getWin: state => state.win
  },
  mutations: {
    setCurrentId (state, id) { state.currentId = id },
    setBoard (state, data) { state.pieces = data.board },
    setGameId (state, id) { state.gameId = id },
    setColor (state, color) { state.color = color },
    setCurrentTurn (state, turn) { state.currentTurn = turn },
    setWin (state, win) { state.win = win },
    addPiece (state, data) {
      Vue.set(state.pieces, `${data.x}${data.y}`, { x: data.x, y: data.y, color: data.color })

      for (let x in data.changedPieces) {
        Vue.set(state.pieces, x, { x: data.changedPieces[x].x, y: data.changedPieces[x].y, color: data.changedPieces[x].color })
      }
    }
  }
})

export default gameStore
