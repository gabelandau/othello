<template>
  <div class="game-header">
    <p class="title is-4">{{ gameJson.initiator }} vs. {{ gameJson.player }}</p>
    <p class="subtitle is-6">Game Started: {{ gameJson.created_at }}</p>
  </div>
</template>

<script>
export default {
  props: ['game'],
  computed: {
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

p {
  text-align: center;
}
</style>
