/**
 * Created by root on 19/06/17.
 */

/*var app = require('express')();
 var server = require('http').Server(app);
 var io = require('socket.io')(server);
 var redis = require('redis');

 server.listen(8890);
 io.on('connection', function (socket) {

 console.log("new client connected");
 var redisClient = redis.createClient();
 redisClient.subscribe('message');

 redisClient.on("message", function(channel, message) {
 console.log("mew message in queue "+ message + "channel");
 socket.emit(channel, message);
 });

 socket.on('disconnect', function() {
 redisClient.quit();
 });

 });*/


var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();


redis.subscribe('test-channel');

redis.on('message', function (channel, message) {
  console.log('Message Received: ' + message);
  message = JSON.parse(message);
  io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000);


/*var app = require('express')();
 var http = require('http').Server(app);
 var io = require('socket.io')(http);
 var Redis = require('ioredis');
 var redis = new Redis();
 redis.subscribe('test-channel', function(err, count) {
 });
 redis.on('message', function(channel, message) {
 console.log('Message Recieved: ' + message);
 message = JSON.parse(message);
 io.emit(channel + ':' + message.event, message.data);
 });
 http.listen(3000, function(){
 console.log('Listening on Port 3000');
 });*/
