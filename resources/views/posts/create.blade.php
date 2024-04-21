<x-app>
    <x-slot name="title">
    新規投稿作成
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
    
     
     
</x-navigation>
    <body>
        <h1>新規投稿作成</h1>
        <form action="/posts" method="POST">
            @csrf
            <div>
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div>
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div>
                <h2>カテゴリー</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                
                
                <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer loading=async></script>
    <style>
        #map {
            height: 400px;
            width: 50%;
        }
    </style>
</head>
<body>
    <h1>投稿に乗せたい場所</h1>
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
                        document.getElementById('address').value = results[0].formatted_address;
                    } else {
                        console.log('No results found');
                    }
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            });
        
            
        }
        
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
        
        
    </script>
    <!-- 住所を表示する場所 -->
    
    <style> 
    .btn--orange {
  color: #fff;
  background-color: #eb6100;
  border-bottom: 5px solid #b84c00;
}
.btn--orange:hover {
  margin-top: 3px;
  color: #fff;
  background: #f56500;
  border-bottom: 2px solid #b84c00;
}
.btn--shadow {
  -webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, .3);
  box-shadow: 0 3px 5px rgba(0, 0, 0, .3);
}
    </style>
    
    
        <a onclick="getCurrentLocation()" class="btn btn--orange btn--cubic btn--shadow">位置情報を取得！</a>
    <h2>住所</h2>
                <input id="address" type="text" name="post[address]" placeholder="タイトル" value=""/>
                <p class="title__error" style="color:red">{{ $errors->first('address') }}</p>
            </div>
    
    
                
            </div>
            <input type="submit" value="保存" class="btn btn--orange btn--cubic btn--shadow" />
        </form>
        <div><a href="/posts">戻る</a></div>
    </body>
</html>
</x-app>
