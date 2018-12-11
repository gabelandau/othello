<template>
  <div class="board">
    <p>Connected Players</p>
    <ul v-for="player in connectedPlayers" :key="player.id">
      <li>{{ player.username }}</li>
    </ul>
    <svg width="604" height="604" style="stroke-width:2;stroke:rgb(0,0,0);">
      <cell-table></cell-table>
      <piece v-for="piece in pieces" :key="piece.id" :x="piece.x" :y="piece.y" :color="piece.color"></piece>
    </svg>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'board',
  props: ['game'],
  data () {
    return {
      connectedPlayers: []
    }
  },
  computed: {
    ...mapGetters({
      pieces: 'getPieces'
    })
  },
  created () {
    let json = JSON.parse(this.game)
    this.$store.commit('setCurrentTurn', json.current_turn)
    this.$store.commit('setBoard', { board: JSON.parse(json.board) })
    this.$store.commit('setGameId', json.id)
    this.$store.commit('setColor', json.color)
    this.$store.commit('setWin', json.ended)

    window.Echo.join(`games.${json.id}`).here(users => {
      this.connectedPlayers = users
    }).leaving(user => {
      this.connectedPlayers.splice(this.connectedPlayers.indexOf(user), 1)
    }).joining(user => {
      this.connectedPlayers.push(user)
    }).listen('BoardUpdated', (data) => {
      this.$store.commit('setBoard', { board: data.board })
      this.$store.commit('setCurrentTurn', data.turn.current_turn)
      if (data.win) {
        this.$store.commit('setWin', true)
      }
    })
  }
}
</script>

<style lang="scss" scoped>
.board {
  width: 604px;
  height: 604px;
  margin: 10px auto;
}

ul, p {
  text-align: center;
  font-size: 14pt;
}
</style>
