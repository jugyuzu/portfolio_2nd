<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出勤確認アプリ</title>
    <style type=text/css>
        #shift{
            display:flex;
        }
    </style>
</head>
<body>
    <div><a href="main.php">homeへ</a></div>
    <div id="app">
        <div>
            <button id="time_card" value="arrive">出社</button>
            <!-- <button id="insert_card">カードを切る</button> -->
            <input type="hidden" value=<?php echo $user; ?> id="user_id">
        </div>
        <div>
            <p>出社時間:<span id="time"></span></p>
            <p>出社場所:<span id="place"></span></p>
        </div>
        <div id="shift">
            <div>
                <table id="arrive">
                    <tr>
                        <th>出勤場所</th>
                        <th>出勤時間</th>
                    </tr>
                </table>
            </div>
            <div>
                <table id="leave">
                    <tr>
                        <th>退社場所</th>
                        <th>退社時間</th>
                    </tr>
                </table>
            </div>
            <p><?php if(isset($time)){echo $time; }?></p>
        </div>
    </div>
    <!-- <script src="https://cdn.geolonia.com/community-geocoder.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        let place = "";
        let arrive = "arrive";
        let leave = "leave";
        
        $('#time_card').on("click",function(){
            navigator.geolocation.getCurrentPosition(get_arrive);
        })
        
        function get_arrive(position){
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
                $.each(datas,function(index, data){
                    $('#' + time_card).append('<tr><td>' + data.place + '</td><td>' + data.date + '</td></tr>');   
                });
                window.alert('成功');
                console.log(datas);
            })
            .fail( (data) => {
                window.alert('失敗');
                console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                console.log("errorThrown    : " + errorThrown.message);
                console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            })
        }
        </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5gyn8gIOSYNWSX3HxptvdTvB7SIJt1AQ"></script>
</body>

</html>