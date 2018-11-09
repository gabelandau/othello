<template>
  <div class="user-list-container">
    <div class="user-list-text">
      <h3 class="title is-3">Welcome!</h3>
      <p>Welcome to online Othello. Click a player below to challenge them to a game!</p>
    </div>
    <nav class="panel">
      <p class="panel-heading">Active Users</p>
      <a class="panel-block" v-for="user in users" :key="user.id">{{ user.username }}</a>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'UserList',
  data () {
    return {
      users: []
    }
  },
  created () {
    window.Echo.join('messages.1').here(users => {
      this.users = users
    }).joining(user => {
      this.users.push(user)
    }).leaving(user => {
      this.users.splice(this.users.indexOf(user), 1)
    })
  }
}
</script>

<style lang="scss" scoped>
.user-list-container {
  width: 50%;
  margin: 0 auto;
}

.user-list-text {
  padding: 10px 3px 10px 3px;
}

h3 {
  margin-bottom: 10px !important;
}
</style>
