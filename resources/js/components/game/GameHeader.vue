<template>
  <div class="game-header">
    <p class="title is-4">{{ gameJson.initiator }} vs. {{ gameJson.player }}</p>
    <p class="subtitle is-6">Game Started: {{ gameJson.created_at }}</p>
    <p class="subtitle is-6">Current Turn: {{ currentTurn }}</p>
    <p class="subtitle is-6">Your Color: {{ gameJson.color.charAt(0).toUpperCase() + gameJson.color.slice(1) }}</p>
    <h2 class="title is-2" v-show="win">Game over!</h2>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  props: ['game'],
  computed: {
    ...mapGetters({
      currentTurn: 'getCurrentTurn',
      win: 'getWin'
    }),
    gameJson () {
      let json = JSON.parse(this.game)
      json.created_at = window.moment(json.created_at).format('MM/DD/YY @ h:mmA')
      return json
    }
  }
}
</script>

<style lang="scss" scoped>
.game-header {
  padding-top: 10px;
}

p, h2 {
  text-align: center;
}

.subtitle {
  margin-bottom: 0px;
}

h2 {
  padding-top: 15px;
  padding-bottom: 15px;
}
</style>
