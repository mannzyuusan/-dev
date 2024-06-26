<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>
    <title>{{ $title }}</title>
    <style>
    h1 {
        color: black;
        font-weight: 550;
    }
    h2 {
        color: black;
        font-weight: 500;
    }
    h3 {
        color: black;
        font-weight: 300;
    }
    body {
        background-color: white;
    }
    p {
        font-weight: 400;
        font-size: 18px;
    }
    #map {  
        text-align: center;
        height: 400px;
        width: 50%;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js',])
</head>
<body>
        {{ $slot }}
    </body>
</html>