<template>
  <div id="messages-list" class="messages-list">
    <div class="message-container" v-for="message in messages" :key="message.id">
      <div class="message-meta">{{ message.created_at }} &lt;{{ message.username }}&gt;</div>
      <div class="message-text">{{ message.body }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['game'],
  data () {
    return {
      messages: []
    }
  },
  created () {
    window.axios.get('/messages').then(response => {
      response.data.forEach(message => {
        message.created_at = window.moment(message.created_at).format('MM/DD/YY @ h:mm:ssA')
        this.messages.push(message)
      })

      this.messages.push({
        'created_at': '',
        'username': 'System',
        'body': 'You are now in the global chat, say hi!'
      })

      this.messages.reverse()
    })

    window.Echo.join(`messages.${this.game}`).listen('MessageSent', ({ message }) => {
      message.created_at = window.moment(message.created_at).format('MM/DD/YY @ h:mm:ssA')
      this.messages.push(message)
    })
  }
}
</script>

<style lang="scss" scoped>
.messages-list {
  height: calc(100vh - 126px);
  overflow: scroll;
}

.message-container {
  padding: 10px;
}

.message-meta {
  font-size: 8pt;
}
</style>
