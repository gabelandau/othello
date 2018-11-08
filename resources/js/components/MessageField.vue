<template>
  <div class="message-field-container">
    <div class="field message-field">
      <div class="control">
        <input v-model="message" class="input" type="text" placeholder="Message..." @keyup.enter="sendMessage()">
      </div>
      <p class="help">Press the enter key to send.</p>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      message: ''
    }
  },
  methods: {
    sendMessage () {
      axios.post('/messages', { body: this.message })
      this.message = ''
    }
  }
}
</script>

<style lang="scss" scoped>
.message-field {
  padding: 10px 15px 5px 15px;
  background-color: #fff;
  -webkit-box-shadow: 3px 0px 5px 0px rgba(163,163,163,0.49);
  -moz-box-shadow: 3px 0px 5px 0px rgba(163,163,163,0.49);
  box-shadow: 3px 0px 5px 0px rgba(163,163,163,0.49);
}

.message-field-container {
  -webkit-box-shadow: -3px 0px 5px 0px rgba(163,163,163,0.49);
  -moz-box-shadow: -3px 0px 5px 0px rgba(163,163,163,0.49);
  box-shadow: -3px 0px 5px 0px rgba(163,163,163,0.49);
  width: 100%;
  position: absolute;
  bottom: -73px;
  height: 73px;
}
</style>
