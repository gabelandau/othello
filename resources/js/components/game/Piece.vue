<template>
  <circle cx="0" cy="0" r="30" stroke="black" stroke-width="1" :fill="fill" :transform="translate"/>
</template>

<script>
export default {
  props: ['x', 'y', 'color'],
  computed: {
    translate () {
      let xTransform = ((this.x - 1) * 75) + 39.5
      let yTransform = ((this.y - 1) * 75) + 39.5

      return `translate(${xTransform},${yTransform})`
    },
    fill () {
      if (this.color === 'white') {
        return 'white'
      } else if (this.color === 'black') {
        return 'black'
      }
    },
    stroke () {
      if (this.color === 'white') {
        return 'black'
      } else if (this.color === 'black') {
        return 'white'
      }
    }
  }
}
</script>
