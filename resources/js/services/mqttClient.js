import mqtt from "precompiled-mqtt";

const options = {
    hostname: 'vash.tech',
    port: 8083,
    protocol: 'mqtts',
    username: 'admin',
    password: 'password'
}

// initialize the MQTT client
const mqttClient = mqtt.connect(options);

// setup the callbacks
mqttClient.on('connect', function () {
    console.log('Connected');
});

export default mqttClient;
