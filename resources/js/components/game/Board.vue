<template>
  <div class="board">
    <svg width="604" height="604" style="stroke-width:2;stroke:rgb(0,0,0);">
      <cell-table></cell-table>
      <piece x="5" y="5" color="white"/>
      <piece x="6" y="6" color="black"/>
    </svg>
  </div>
</template>

<script>
export default {
  name: 'board'
}
</script>

<style lang="scss" scoped>
.board {
  width: 604px;
  height: 604px;
  margin: 10px auto;
}
</style>
