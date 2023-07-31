<template>
    <div class="container">
        <div class="row justify-content-center mb-4">
            <h3 class="text-center">Automatic Watering & Monitoring</h3>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Sensor Waterflow</div>
                    <div class="card-body">
                        <div id="water-flow">
                            <div>-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Sensor Ultrasonik</div>
                    <div class="card-body">
                        <div id="ultra-sonic">
                            <div>-</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Sensor Kelembapan Tanah</div>
                    <div class="card-body">
                        <div id="soil-mosture">
                            <div>-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Sensor Hujan</div>
                    <div class="card-body">
                        <div id="rain-censor">
                            <div>-</div>
                        </div>
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
                $('#water-flow div').remove();
                $('#water-flow').append(`<div>${message}</div>`);
            } else if (topic == '1/monitor/ultra-sonic') {
                $('#ultra-sonic div').remove();
                $('#ultra-sonic').append(`<div>${message}</div>`);
            } else if (topic == '1/monitor/soil-mosture') {
                $('#soil-mosture div').remove();
                $('#soil-mosture').append(`<div>${message}</div>`);
            } else if (topic == '1/monitor/rain-censor'){
                $('#rain-censor div').remove();
                $('#rain-censor').append(`<div>${message}</div>`);
            }
            console.log('Received message:', topic, message.toString());
        });
    };
</script>