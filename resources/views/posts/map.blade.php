<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
<head>
    <title>Google Maps</title>
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
    <!-- 検索ボックス -->
    <input type="text" id="search-box" placeholder="検索">
    <button onclick="searchLocation()">探す</button>
    <!-- 地図を表示するための div 要素 -->
    <div id="map"></div>

    <script>
        var map;
        var marker;

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

            // 検索ボックスを地図に追加
            var input = document.getElementById('search-box');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // ピンを地図に追加
            marker = new google.maps.Marker({
                map: map,
                draggable: true, // ピンをドラッグ可能にする
            });

            // ピンの位置が変更されたときのイベントハンドラ
            marker.addListener('dragend', function() {
                displayAddress(marker.getPosition());
            });
        }

        // 検索ボタンをクリックしたときの処理
        function searchLocation() {
            var input = document.getElementById('search-box').value;
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': input}, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    displayAddress(marker.getPosition());
                } else {
                    alert('位置情報が見つかりませんでした：' + status);
                }
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
    <h2 id="address">ここに住所を表示する</h2>
</body>
</html>
