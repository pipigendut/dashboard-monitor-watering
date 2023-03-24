var mqtt = require('mqtt')

var options = {
    hostname: 'pipigendut.tech',
    port: 8083,
    protocol: 'mqtts',
    username: 'admin',
    password: 'password'
}

// initialize the MQTT client
var client = mqtt.connect(options);

// setup the callbacks
client.on('connect', function () {
    console.log('Connected');

    client.subscribe('1/monitor/water')
});

client.on('message', function (topic, message) {
    // called each time a message is received
    console.log('Received message:', topic, message.toString());
});