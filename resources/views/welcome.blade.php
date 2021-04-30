<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app.css">
        <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

    </head>
    <body>
    <div id="app">
        <navbar></navbar>
        <router-view></router-view>
    </div>

    <script src="/js/app.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
    </body>
</html>
