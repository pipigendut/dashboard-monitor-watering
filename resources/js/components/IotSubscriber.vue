<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Water Flow</div>
                    <div class="card-body">
                        <div id="water-flow">-</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Ultra Sonic</div>
                    <div class="card-body">
                        <div id="ultra-sonic">-</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Soil Mosture</div>
                    <div class="card-body">
                        <div id="soil-mosture">-</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Rain Censor</div>
                    <div class="card-body">
                        <div id="rain-censor">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import mqttClient from "../services/mqttClient";
    export default {
        name: 'iot-subscriber',
        mounted() {
            console.log('Component mounted.')
        }
    }

    if (document.getElementById("home")) {    

        mqttClient.subscribe('1/monitor/water')
        mqttClient.subscribe('1/monitor/ultra-sonic')
        mqttClient.subscribe('1/monitor/soil-mosture')
        mqttClient.subscribe('1/monitor/rain-censor')

        mqttClient.on('message', function (topic, message) {
            // called each time a message is received
            if (topic == '1/monitor/water') {
                $('#water-flow').text(message);
            } else if (topic == '1/monitor/ultra-sonic') {
                $('#ultra-sonic').text(message);
            } else if (topic == '1/monitor/soil-mosture') {
                $('#soil-mosture').text(message);
            } else if (topic == '1/monitor/rain-censor'){
                $('#rain-censor').text(message);
            }
            console.log('Received message:', topic, message.toString());
        });
    };
</script>