<!DOCTYPE html>
<html>
<head>
  <title>Socket App - test</title>

</head>
<body>
<div id="app">

  <h2>New Users</h2>

  <ul>
    <li v-for="user in users">@{{ user }}</li>
  </ul>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
  var socket = io('http://127.0.0.1:3000');

  new Vue({
    el: '#app',
    data: {
      users: []
    },
    mounted: function () {
      socket.on('test-channel:UserSignedUp', function (data) {
        this.users.push(data.username);
      }.bind(this))
    }
  })
</script>
</body>
</html>