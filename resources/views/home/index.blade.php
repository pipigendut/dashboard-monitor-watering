@extends('layouts.app')

@section('content')
    <div id="home"></div>
    <div id="my-div"></div>
    <iot-subscriber> </iot-subscriber>
@endsection

<!-- <script type="application/javascript">
    function recursively_ajax(){
        $.ajax({
            type:'POST',
            url:"/api/subscribe_robot/1",
            data:{topic: 'monitor/water'},
            success: function(data){
                $('#my-div').text(data.message[0]);
                setTimeout(recursively_ajax, 3000)
            },
            error: function(request, status, error){
                setTimeout(recursively_ajax, 3000)
            }
        });
    }
    recursively_ajax();
</script> -->