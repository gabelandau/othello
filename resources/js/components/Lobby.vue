<template>
  <div>
    <div class="container">
      <div class="user-list-text">
        <h3 class="title is-3">Welcome!</h3>
        <p>Welcome to online Othello. Click a player below to challenge them to a game! Or, click any of your pending invites to accept it and start playing!</p>
      </div>
      <div class="columns">
        <div class="column">
          <nav class="panel users-list">
            <p class="panel-heading">Active Users</p>
            <a v-for="user in users" class="panel-block" :key="user.id" @click="userClicked(user)">{{ user.username }}</a>
          </nav>
        </div>
        <div class="column">
          <nav class="panel invites-list">
            <p class="panel-heading">Pending Invites</p>
            <a v-for="invite in invites" class="panel-block" :key="invite.id">Invite from: {{ invite.username }}</a>
          </nav>
        </div>
      </div>
    </div>

    <div class="modal" v-bind:class="{ 'is-active': showUserModal }">
      <div class="modal-background" @click="showUserModal = false"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">What would you like to do?</p>
          <button class="delete" aria-label="close" @click="showUserModal = false"></button>
        </header>
        <section class="modal-card-body">
          <p class="modal-inline-header">You selected: {{ selectedUser.username }}</p>
          <button class="button is-fullwidth is-link" @click="sendInvite()">Invite To Game</button>
        </section>
        <footer class="modal-card-foot">
          <button class="button">Cancel</button>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['room', 'user'],
  name: 'Lobby',
  data () {
    return {
      users: [],
      invites: [],
      selectedUser: {
        username: null
      },
      showUserModal: false
    }
  },
  methods: {
    userClicked (user) {
      this.selectedUser = user
      this.showUserModal = true
    },
    sendInvite () {
      window.axios.post('/invites', {
        player: this.selectedUser.id
      })
    }
  },
  created () {
    window.axios.get('/invites').then(response => {
      response.data.forEach(invite => {
        this.invites.push(invite)
      })
    })

    window.Echo.join(`messages.${this.room}`).here(users => {
      this.users = users
    }).joining(user => {
      this.users.push(user)
    }).leaving(user => {
      this.users.splice(this.users.indexOf(user), 1)
    })

    window.Echo.join(`invites.${this.user}`).listen('InviteSent', ({ invite }) => {
      this.invites.push(invite)
    })
  }
}
</script>

<style lang="scss" scoped>
.container {
  width: 95%;
  margin: 0 auto;
}

.user-list-text {
  padding: 10px 3px 10px 3px;
}

h3 {
  margin-bottom: 10px !important;
}

.modal-inline-header {
  font-size: 14pt;
  padding-bottom: 15px;
}

.users-list {
  padding-right: 10px;
}

.invites-list {
  padding-left: 10px;
}
</style>
