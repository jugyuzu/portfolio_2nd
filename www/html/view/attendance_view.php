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
            <button id="time_card" onclick="time_cart()">出社</button>
        </div>
        <div>
            <p>出社時間:<span id="time"></span></p>
            <p>出社場所:<span id="place"></span></p>
        </div>
        <div id="shift">
            <div id="arrive">
                <table>
                    <th>出勤場所</th>
                    <th>出勤時間</th>
                </table>
            </div>
            <div id="leave">
                <table>
                    <th>退社場所</th>
                    <th>退社時間</th>
                </table>
            </div>
            <p><?php if(isset($time)){echo $time; }?></p>
        </div>
    </div>
    <!-- <script src="https://cdn.geolonia.com/community-geocoder.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        let place = "";
        let arrive = "出社";
        let leave = "退社";

        function time_cart(){
            navigator.geolocation.getCurrentPosition(get_arrive);
        }
        
        function get_arrive(position){
            let date = new Date();
            get_arraive = date.getFullYear() + '/' + (date.getMonth()+1) + '/' + date.getDate() + '/' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            //緯度
            lat = position.coords.latitude;
            //経度
            lng = position.coords.longitude;
            
            var geocoder = new google.maps.Geocoder();
            latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    let geo_place = document.getElementById("place");
                    let time_card = document.getElementById("time_card").textContent;
                    console.log(results);
                    add = results[4].address_components[2]['long_name'];
                    add += results[4].address_components[1]['long_name'];
                    add += results[4].address_components[0]['long_name'];
                    set_button(time_card, add, geo_place, get_arraive)
                }
                else {
                    alert("エラー" + status);
                }
            })
        }
        function set_button(time_card, add, geo_place, get_arraive){
                if(time_card === arrive){
                    document.getElementById("time_card").textContent = leave;
                }else {
                    document.getElementById("time_card").textContent = arrive;
                }
                let span = document.getElementById("time");
                span.textContent = get_arraive;
                geo_place.textContent = add;
                ajax_db(time_card, add, get_arraive);
            
        }
        
        function ajax_db(time_card, add, get_arraive){
            let t=time_card;
            let a=add;
            let g=get_arrive;
            window.alert('ajax');
            $.ajax({
                url: 'insert_attendance.php',
                data: {
                    card: t,
                    place: a,
                    time: g
                },
                method: 'GET',
                dataType: 'json',
            }).done( (data)=>{
                window.alert(data);
            }).fail( (data)=>{
                window.alert('失敗');
            })
            
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5gyn8gIOSYNWSX3HxptvdTvB7SIJt1AQ"></script>
</body>
</html>