<template>
  <div>
    <div class="container">
      <div class="notification" v-bind:class="{ 'is-success': inviteResponse.status === 200 }" v-if="inviteResponse.show">
        <button class="delete" @click="inviteResponse.show = false"></button>
        {{ inviteResponse.text }}
      </div>

      <div class="user-list-text">
        <h3 class="title is-3">Welcome!</h3>
        <p>Welcome to online Othello. Click a player below to challenge them to a game, click any of your pending invites to accept it and start playing, or click any of your active games to return to the action!</p>
      </div>
      <div class="columns">
        <div class="column">
          <nav class="panel users-list">
            <p class="panel-heading">Active Users</p>
            <a v-for="user in users" class="panel-block" v-bind:class="{ 'current-user': user.id == userid }" :key="user.id" @click="userClicked(user)">{{ user.username }}{{ user.id == userid ? ' (you)' : ''}}</a>
          </nav>
        </div>
        <div class="column">
          <nav class="panel invites-list">
            <p class="panel-heading">Pending Invites</p>
            <div v-for="invite in invites" class="panel-block" :key="invite.id" @click="inviteClicked(invite)">
              <div class="columns">
                <div class="column">From: {{ invite.username }}</div>
                <div class="column invite-datetime">{{ invite.created_at }}</div>
              </div>
            </div>
          </nav>

          <nav class="panel invites-list">
            <p class="panel-heading">Active Games</p>
            <div v-for="game in games" class="panel-block" :key="game.id" @click="gameClicked(game)">
              <div class="columns">
                <div class="column">{{ game.initiator }} challenged {{ game.player }}</div>
                <div class="column invite-datetime">{{ game.created_at }}</div>
              </div>
            </div>
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

    <div class="modal" v-bind:class="{ 'is-active': showInviteModal }">
      <div class="modal-background" @click="showInviteModal = false"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">You've been invited!</p>
          <button class="delete" aria-label="close" @click="showInviteModal = false"></button>
        </header>
        <section class="modal-card-body">
          <p class="modal-inline-header">You were invited to a game by: {{ selectedInvite.username }}. What would you like to do?</p>
          <button class="button is-fullwidth is-link bottom-padding" @click="acceptInvite(selectedInvite.id)">Accept</button>
          <button class="button is-fullwidth is-link" @click="declineInvite()">Decline</button>
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
  props: ['room', 'userid'],
  name: 'Lobby',
  data () {
    return {
      users: [],
      invites: [],
      games: [],
      selectedUser: {
        username: null
      },
      selectedInvite: {
        username: null,
        id: null
      },
      showUserModal: false,
      showInviteModal: false,
      inviteResponse: {
        show: false,
        response: 0
      }
    }
  },
  methods: {
    userClicked (user) {
      if (!(user.id == this.userid)) { // eslint-disable-line
        this.selectedUser = user
        this.showUserModal = true
      }
    },
    inviteClicked (invite) {
      this.selectedInvite = invite
      this.showInviteModal = true
    },
    sendInvite () {
      window.axios.post('/invites', {
        player: this.selectedUser.id
      }).then(res => {
        if (res.status === 200) {
          this.inviteResponse.text = res.data
          this.showUserModal = false
          this.inviteResponse.show = true
          this.inviteResponse.status = res.status

          setTimeout(() => {
            this.inviteResponse.show = false
          }, 3000)
        }
      })
    },
    acceptInvite (id) {
      window.axios.post(`/invite/${id}/accept`).then((res) => {
        this.getGames()
      }).catch((err) => console.log(err))
    },
    declineInvite () {
      //
    },
    getGames () {
      window.axios.get('/games').then(response => {
        this.games = []

        response.data.forEach(game => {
          game.created_at = `Started: ${window.moment(game.created_at).format('MM/DD/YY')}`
          this.games.push(game)
        })
      })
    },
    gameClicked (game) {
      //
    }
  },
  mounted () {
    this.getGames()

    window.axios.get('/invites').then(response => {
      response.data.forEach(invite => {
        invite.created_at = window.moment(invite.created_at).format('MM/DD/YY @ h:mm:ssA')
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

    window.Echo.join(`invites.${this.userid}`).listen('InviteSent', ({ invite }) => {
      invite.created_at = window.moment(invite.created_at).format('MM/DD/YY @ h:mm:ssA')
      this.invites.unshift(invite)
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

.current-user {
  background-color: #f5f5f5;
  cursor: not-allowed;
}

.panel-block {
  .columns {
    width: 100%;
  }
}

.invite-datetime {
  text-align: right;
}

.notification {
  position: absolute;
  z-index: 100;
  margin: 10px;
  width: 100%;
}

.bottom-padding {
  margin-bottom: 10px;
}
</style>
