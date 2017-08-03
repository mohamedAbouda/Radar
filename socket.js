var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var notificationclient = new Redis();
var notifications = new Redis();

notificationclient.subscribe('test-channel');
notificationclient.on('message',function (channel,notification){
	var data=JSON.parse(notification);
	data.dataType='notification';
	io.sockets.emit('order:' +data.order_id,data);
	console.log(notification);
});

notifications.subscribe('notifications');
notifications.on('message',function (channel,notification){
	var data=JSON.parse(notification);
	//data.dataType='notification';
	io.sockets.emit('user',data);
	console.log(notification);
});
server.listen(3000,function(){
	console.log('notification server is running');
});