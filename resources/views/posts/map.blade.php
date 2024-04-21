<x-app>
    <x-slot name="title">
    マップ
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
<body>
<h1>My Google Maps</h1>

<!-- 検索ボックスとボタン -->
<input type="text" id="searchBox" placeholder="場所を検索">
<button onclick="searchPlace()">検索</button>

<!-- 「位置情報を取得する」ボタン -->
<button onclick="getCurrentLocation()">位置情報を取得する</button>

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

    // 検索ボックスで入力された場所を検索する関数
    function searchPlace() {
        var input = document.getElementById('searchBox').value;
        var geocoder = new google.maps.Geocoder();
        // 住所を検索するリクエストを作成
        geocoder.geocode({'address': input}, function(results, status) {
            if (status === 'OK') {
                // 検索結果の最初の場所を地図上に表示
                map.setCenter(results[0].geometry.location);
                if (typeof marker !== 'undefined') {
                    marker.setMap(null);
                }
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                // 住所を表示
                document.getElementById('address').innerHTML = results[0].formatted_address;
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    // 「位置情報を取得する」ボタンがクリックされたときの処理
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                // ピンが既に存在する場合は削除する
                if (typeof marker !== 'undefined') {
                    marker.setMap(null);
                }
                // ピンを設定
                marker = new google.maps.Marker({
                    position: currentLocation,
                    map: map
                });
                // 住所を表示する関数を呼び出し
                displayAddress(currentLocation);
                // 地図の中心を現在地に設定
                map.setCenter(currentLocation);
            }, function() {
                handleLocationError(true);
            });
        } else {
            // ブラウザがGeolocationをサポートしていない場合の処理
            handleLocationError(false);
        }
    }

    // 位置情報取得時のエラーハンドリング
    function handleLocationError(browserHasGeolocation) {
        var error_message = browserHasGeolocation ?
            '位置情報の取得に失敗しました' :
            'お使いのブラウザはGeolocationをサポートしていません';
        alert(error_message);
    }
</script>
<!-- 住所を表示する場所 -->
<h2 id="address">この住所を入力する！</h2>

<a href="/posts/map2">近場検索はこちらから！</a>
</body>
</html>
</x-app>