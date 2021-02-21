<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出勤確認アプリ</title>
    <style type=text/css>
        body{
            background-color: #F5F5F5; 
        }
        #shift,#top{
            display:flex;
        }
        #arrive{
            margin-right:50px;
        }
        table,th,td{
            border: solid 1px black;
            width: 600px;
        }
        td{
            text-align:center;
        }
        #button{
            margin:20px 60px;
            border: 2px solid #000;
            border-radius: 0;
            background: #fff;

            -webkit-transform-style: preserve-3d;

            transform-style: preserve-3d;
        }

        #button:before {
            position: absolute;
            top: 0;
            left: 0;

            width: 2px;
            height: 100%;

            content: '';
            -webkit-transition: all .3s;
            transition: all .3s;

            background: #000;
        }

        #button:hover {
            color: #fff;
            background: #000;
        }

        #button:hover:before {
            background: #fff;
        }
        .time_holder{
            width:300px;
            line-height: 40px;
        }
    </style>
</head>
<body>
    <div><a href="main.php">homeへ</a></div>
    <div id="top">
        <div id="button">
            <button id="time_card" value="arrive">出社</button>
            <input type="hidden" value=<?php echo $user; ?> id="user_id">
        </div>
        <div class="time_holder">
            <p>時間:<span id="time"></span></p>
        </div>
        <div class="time_holder">
            <p>場所:<span id="place"></span></p>
        </div>
    </div>
    <div id="text">
    <div id="shift">
        <div>
            <table>
                <tr id="arrive">
                    <th>出勤場所</th>
                    <th>出勤時間</th>
                </tr>
                
            </table>
        </div>
        <div>
            <table>
                <tr id="leave">
                    <th>退社場所</th>
                    <th>退社時間</th>
                </tr>
            </table>
        </div>
    </div>
    </div>
    
    <!-- <script src="https://cdn.geolonia.com/community-geocoder.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        let place = "";
        let arrive = "arrive";
        let leave = "leave";
        
        $('#time_card').on("click",function(){
            //window.alert('time');
            navigator.geolocation.getCurrentPosition(get_arrive,error);
        })
        
        function error(){
            window.alert('失敗しました');
        }

        function get_arrive(position){
            //window.alert('get_arrive');
            let date = new Date();
            //get_time = date.getFullYear() + '/' + (date.getMonth()+1) + '/' + date.getDate() + '/' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            get_time = date.getFullYear() + ':' + (date.getMonth()+1) + ':' + date.getDate() + ':' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            //緯度
            lat = position.coords.latitude;
            //経度
            lng = position.coords.longitude;

            let geocoder = new google.maps.Geocoder();
            let latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    let geo_place = document.getElementById("place");
                    let time_card = $('#time_card').val();
                    //console.log(time_card);
                    add = results[4].address_components[2]['long_name'];
                    add += results[4].address_components[1]['long_name'];
                    add += results[4].address_components[0]['long_name'];
                    set_button(time_card, add, geo_place, get_time)
                }
                else {
                    alert("エラー" + status);
                }
            })
        }
        function set_button(time_card, add, geo_place, get_time){
            //window.alert('set_button');
                 if(time_card === arrive){
                     $('#time_card').text('退社');
                     $('#time_card').val(leave);
                 }else {
                     $('#time_card').text('出社');
                     $('#time_card').val(arrive);
                 }
                let span = document.getElementById("time");
                span.textContent = get_time;
                geo_place.textContent = add;
                ajax_db(time_card, add, get_time);
            
        }

        //$("#insert_card").on("click",function(){
        function ajax_db(time_card, add, get_time){
            //window.alert(time_card);
            $.ajax({
                type: "POST",
                url: "./insert_attendance.php",
                dataType: "json",
                data: {
                    card: time_card,//$('#time_card').val(),
                    place: add,//$('#place').text(),
                    time: get_time//$('#time').text()
                }
            })
            .done( (datas) => {
                $('#' + time_card).after('<tr><td>' + datas.place + '</td><td>' + datas.date + '</td></tr>');   
                //window.alert('成功');
                //console.log(datas);
            })
            .fail( (data) => {
                window.alert('失敗');
                // console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                // console.log("errorThrown    : " + errorThrown.message);
                // console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            })
        }
        window.onload = load;
        function load(){
            $.ajax({
                url:"./get_attendance_data.php",
                dataType:"json"
            }).done( (datas) => {
                //console.log(datas);
                if(datas.length === 0){
                    alert('出社ボタンを押して、記録しましょう！');   
                }   
                $.map(datas, function(value,index){
                    if(index === 0){
                        value.forEach(data => {
                            $('#arrive').after('<tr><td>' + data['arrive_place'] + '</td><td>'+ data['create_datetime'] + '</td></tr>');
                        });
                    }else if(index === 1){
                        value.forEach(data =>{ 
                            $('#leave').after('<tr><td>' + data['leave_place'] + '</td><td>'+ data['leave_time'] + '</td></tr>');
                        });
                    }
                });
            }).fail( (data) => {
                window.alert('失敗');
            })
        }
        </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5gyn8gIOSYNWSX3HxptvdTvB7SIJt1AQ"></script>
</body>

</html>