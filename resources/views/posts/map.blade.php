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
    <!-- 検索ボックス -->
    <input type="text" id="searchBox" placeholder="地名を入力してください">
    <!-- 地図を表示するための div 要素 -->
    <div id="map"></div>

    <script>
        // Google Maps API を使用して地図を初期化する関数
        function initMap() {
            // 地図を表示する要素を取得
            var mapElement = document.getElementById('map');
            // 検索ボックスを取得
            var searchBox = document.getElementById('searchBox');
            // デフォルトの中心座標とズームレベル
            var defaultLocation = { lat: -34.397, lng: 150.644 };
            var defaultZoom = 8;

            // 地図を作成
            var map = new google.maps.Map(mapElement, {
                center: defaultLocation,
                zoom: defaultZoom
            });

            // 検索ボックスを地図に追加
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchBox);

            // Autocompleteオブジェクトを作成
            var autocomplete = new google.maps.places.Autocomplete(searchBox);

            // ユーザーが場所を選択すると、その場所のジオコーディングが行われます
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // ジオコーディングで場所が見つからない場合はエラーを表示
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // 地図の中心を選択された場所に移動
                map.setCenter(place.geometry.location);
                map.setZoom(defaultZoom);
            });
        }
    </script>


    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
     <a href='/posts/index'>ホームはこちら</a>

</body>
</html>
