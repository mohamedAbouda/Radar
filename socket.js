var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var notificationclient = new Redis();
var notifications = new Redis();

notificationclient.subscribe('location-channel');
notificationclient.on('message',function (channel,location){
	var data=JSON.parse(location);
	data.dataType='location';
	io.sockets.emit('location:' +data.driver_id,data);
	console.log(location);
});

/*notifications.subscribe('notifications');
notifications.on('message',function (channel,notification){
	var data=JSON.parse(notification);
	//data.dataType='notification';
	io.sockets.emit('user',data);
	console.log(notification);
});*/
server.listen(3000,function(){
	console.log('location server is running');
});