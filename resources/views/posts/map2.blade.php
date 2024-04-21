<x-app>
    <x-slot name="title">
    マップ2
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
<body>
<h1>My Google Maps</h1>
<body>
<h1>近辺検索</h1>

<!-- 「位置情報を取得する」ボタン -->
<button onclick="getCurrentLocation()">位置情報を取得する</button>

<!-- 「近辺検索」ボックスとボタン -->
<input type="text" id="keyword" placeholder="キーワードを入力">
<button onclick="searchNearby()">近辺検索</button>

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
                // 地図の中心を現在地に設定
                map.setCenter(currentLocation);
                // 住所を取得
                displayAddress(currentLocation);
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

    // 近辺検索を行う関数
    
    async function searchNearby() {
        const {PlacesService} = await google.maps.importLibrary("places");
        var keyword = document.getElementById('keyword').value;
        var radius = 10000; // 半径10000m
        var request = {
            location: marker.getPosition(), // ピンの位置を中心に検索
            radius: radius,
            keyword: keyword
        };
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                // 検索結果を地図上に表示
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        });
    }

    // マーカーを作成する関数
    function createMarker(place) {
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });
        // マーカーをクリックしたときの動作を定義（ここでは情報ウィンドウを表示）
        google.maps.event.addListener(marker, 'click', function() {
            var infowindow = new google.maps.InfoWindow({
                content: '<strong>' + place.name + '</strong><br>' + place.vicinity
            });
            infowindow.open(map, this);
        });
    }
</script>
<!-- 住所を表示する場所 -->
<h2 id="address">この住所を入力する！</h2>
<a href="/posts/">投稿一覧画面に戻る</a>
</body>
</html>
</x-app>