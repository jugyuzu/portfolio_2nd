<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出勤確認アプリ</title>
</head>
<body>
    <div><a href="main.php">homeへ</a></div>
    <div id="app">
        <div>
            会社の住所: 
            <input type="text" id="address">
            <button id="exec">設定</button>
        </div>
        <div>
            <button onclick="arraive_work()">出社する</button>
            <!-- <button onclick="test()">出社する</button> -->
        </div>
        <p><?php echo $session_id; ?></p>
        <div>
            <p>会社住所:<span id="company"></span></p>
            <p>出社時間:<span id="time"></span></p>
            <p>出社場所:<span id="place"></span></p>
        </div>
    </div>
    <script src="https://cdn.geolonia.com/community-geocoder.js"></script>
    <script>
        let place = "";
        document.getElementById('exec').addEventListener('click', () => {
            //let log = document.getElementById('address').value;
            if (document.getElementById('address').value) {
                getLatLng(document.getElementById('address').value, latlng);
            }
            function latlng(address) {
                let span = document.getElementById("company");
                span.innerHTML = address.addr;
            }
        })
        function arraive_work(){
            navigator.geolocation.getCurrentPosition(get_arrive);
        }
        function get_arrive(position){
            let date = new Date();
            get_arraive = date.getFullYear() + '/' + (date.getMonth()+1) + '/' + date.getDate() + '/' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            //緯度
            lat         = position.coords.latitude;
            //経度
            lng        = position.coords.longitude;

            let span = document.getElementById("time");
            span.innerHTML = get_arraive;

            var geocoder = new google.maps.Geocoder();
            latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    let place = document.getElementById("place");
                    console.log(results);
                    place.innerHTML = results[4].formatted_address;
                }
                else {
                    alert("エラー" + status);
                }
            })
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5gyn8gIOSYNWSX3HxptvdTvB7SIJt1AQ"></script>
</body>
</html>