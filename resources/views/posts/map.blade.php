<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Example</title>
    <!-- Google Maps JavaScript API の読み込み -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
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
        var map;

        // Google Maps API を使用して地図を初期化する関数
        function initMap() {
            // 地図を表示する要素を取得
            var mapElement = document.getElementById('map');
            // 東京駅の位置情報
            var tokyoStation = { lat: 35.681236, lng: 139.767125 };
            var defaultZoom = 15; // デフォルトのズームレベル

            // 地図を作成
            map = new google.maps.Map(mapElement, {
                center: tokyoStation, // 東京駅を中心に表示
                zoom: defaultZoom
            });

            // マップ上でクリックされたときのイベントハンドラを追加
            map.addListener('click', function(event) {
                // クリックされた位置の緯度経度を取得
                var clickedLocation = event.latLng;
                // ピンが既に存在する場合は削除する
                if (typeof marker !== 'undefined') {
                    marker.setMap(null);
                }
                // ピンを設定
                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: map
                });
                // 住所を表示する関数を呼び出し
                displayAddress(clickedLocation);
            });
        }

        // 住所を表示する関数
        function displayAddress(latlng) {
            // Geocoderオブジェクトを作成
            var geocoder = new google.maps.Geocoder();
            // 住所を取得するリクエストを作成
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        // 取得した住所を表示
                        document.getElementById('address').innerHTML = results[0].formatted_address;
                    } else {
                        console.log('No results found');
                    }
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>
    <!-- 住所を表示する場所 -->
    <h1 id="address">ここに住所を表示する</h1>
</body>
</html>
