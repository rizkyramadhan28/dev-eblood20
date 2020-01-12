<!DOCTYPE html>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dev Eblood</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div id="app">
        <main-app></main-app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>