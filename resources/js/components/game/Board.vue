<template>
  <div class="board">
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
  computed: {
    ...mapGetters({
      pieces: 'getPieces'
    })
  },
  mounted () {
    let json = JSON.parse(this.game)
    this.$store.commit('setBoard', { board: JSON.parse(json.board) })
    window.Echo.join(`games.${json.id}`).listen('BoardUpdated', (data) => {
      this.$store.commit('setBoard', { board: data.board })
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
</style>
