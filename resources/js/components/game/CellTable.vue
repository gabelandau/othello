<template>
  <svg>
    <rect x="2" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 1)" />
    <rect x="77" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 1)" />
    <rect x="152" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 1)" />
    <rect x="227" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 1)" />
    <rect x="302" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 1)" />
    <rect x="377" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 1)" />
    <rect x="452" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 1)" />
    <rect x="527" y="2" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 1)" />

    <rect x="2" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 2)" />
    <rect x="77" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 2)" />
    <rect x="152" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 2)" />
    <rect x="227" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 2)" />
    <rect x="302" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 2)" />
    <rect x="377" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 2)" />
    <rect x="452" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 2)" />
    <rect x="527" y="77" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 2)" />

    <rect x="2" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 3)" />
    <rect x="77" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 3)" />
    <rect x="152" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 3)" />
    <rect x="227" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 3)" />
    <rect x="302" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 3)" />
    <rect x="377" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 3)" />
    <rect x="452" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 3)" />
    <rect x="527" y="152" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 3)" />

    <rect x="2" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 4)" />
    <rect x="77" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 4)" />
    <rect x="152" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 4)" />
    <rect x="227" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 4)" />
    <rect x="302" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 4)" />
    <rect x="377" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 4)" />
    <rect x="452" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 4)" />
    <rect x="527" y="227" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 4)" />

    <rect x="2" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 5)" />
    <rect x="77" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 5)" />
    <rect x="152" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 5)" />
    <rect x="227" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 5)" />
    <rect x="302" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 5)" />
    <rect x="377" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 5)" />
    <rect x="452" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 5)" />
    <rect x="527" y="302" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 5)" />

    <rect x="2" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 6)" />
    <rect x="77" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 6)" />
    <rect x="152" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 6)" />
    <rect x="227" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 6)" />
    <rect x="302" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 6)" />
    <rect x="377" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 6)" />
    <rect x="452" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 6)" />
    <rect x="527" y="377" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 6)" />

    <rect x="2" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 7)" />
    <rect x="77" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 7)" />
    <rect x="152" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 7)" />
    <rect x="227" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 7)" />
    <rect x="302" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 7)" />
    <rect x="377" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 7)" />
    <rect x="452" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 7)" />
    <rect x="527" y="452" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 7)" />

    <rect x="2" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(1, 8)" />
    <rect x="77" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(2, 8)" />
    <rect x="152" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(3, 8)" />
    <rect x="227" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(4, 8)" />
    <rect x="302" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(5, 8)" />
    <rect x="377" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(6, 8)" />
    <rect x="452" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(7, 8)" />
    <rect x="527" y="527" width="75" height="75" style="fill:green;stroke-width:2;stroke:rgb(0,0,0);" @click="clicked(8, 8)" />
  </svg>
</template>

<script>
import { addPiece } from '../../functions/game'

export default {
  name: 'cell-table',
  methods: {
    clicked (x, y) {
      addPiece(x, y, 'black')
    }
  }
}
</script>
