<template>
  <nav class="panel">
    <p class="panel-heading">Active Users</p>
    <a class="panel-block" v-for="user in users" :key="user.id">{{ user.username }}</a>
  </nav>
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
    window.Echo.join('messages.0')
      .here(users => {
        this.users = users
      })
      .joining(user => {
        this.users.push(user)
      })
      .leaving(user => {
        this.users.splice(this.users.indexOf(user), 1)
      })
  }
}
</script>
