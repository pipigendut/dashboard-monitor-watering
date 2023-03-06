<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class RobotController extends Controller
{
    /**
     * Handle subscribe robot
     * 
     * @return \Illuminate\Http\Response
     */
    public function subscribeRobot(Request $request, string $robot_id)
    {
        $data = $request->validate([
            'topic' => 'required'
        ]);
        $topic = $request->post('topic');
        $mqtt = MQTT::connection();
        $result = [];

        try {
            $mqtt->subscribe($robot_id."/$topic", function (string
                $topic, string $message) use ($mqtt, &$result) {
                $result['message'] = explode("@",$message);
                $mqtt->interrupt();
            }, 1);
            $mqtt->loop(true);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json("No Data", 400);
        }
    }
}


