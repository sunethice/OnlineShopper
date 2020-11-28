<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="/">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ Config::get('api.app_name') }}</title>
    </head>

    <body>
        <div id="root">
            <app>

            </app>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
