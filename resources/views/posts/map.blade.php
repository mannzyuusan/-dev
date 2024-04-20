<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Example</title>
    <!-- Google Maps JavaScript API の読み込み -->
    
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>My Google Map</h1>
    <!-- 地図を表示するための div 要素 -->
    <div id="map"></div>

    <script>
        // Google Maps API を使用して地図を初期化する関数
        function initMap() {
            // 地図を表示する要素を取得
            var mapElement = document.getElementById('map');

            // 地図を表示するためのオプションを設定
            var mapOptions = {
                center: { lat: -34.397, lng: 150.644 }, // 地図の中心座標
                zoom: 8 // ズームレベル
            };

            // 地図を作成
            var map = new google.maps.Map(mapElement, mapOptions);

            // マーカーを追加する位置の座標
            var markerPosition = { lat: -34.397, lng: 150.644 };

            // マーカーを作成
            var marker = new google.maps.Marker({
                position: markerPosition,
                map: map,
                title: 'Marker Title' // マーカーに表示するタイトル
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
</body>
</html>
