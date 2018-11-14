import './bootstrap'

window.Vue = require('vue')

window.Vue.component('message-field', require('./components/MessageField.vue'))
window.Vue.component('messages', require('./components/Messages.vue'))
window.Vue.component('lobby', require('./components/Lobby.vue'))
window.Vue.component('game-header', require('./components/game/GameHeader.vue'))
window.Vue.component('board', require('./components/game/Board.vue'))
window.Vue.component('piece', require('./components/game/Piece.vue'))
window.Vue.component('cell-table', require('./components/game/CellTable.vue'))

new window.Vue({ // eslint-disable-line no-new
  el: '#app'
})
