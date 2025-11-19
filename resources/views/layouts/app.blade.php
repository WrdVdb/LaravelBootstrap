@php
$locale = app()->getLocale();
$ROUTE_PARAMS = Route::current()->parameters();
$ALTERNATE_ROUTE_PARAMS = $ROUTE_PARAMS;
$ALTERNATE_ROUTE_PARAMS['locale'] = ($locale == 'nl') ? 'en' : 'nl';
$LOCALE_ROUTE = route(Route::currentRouteName(), $ROUTE_PARAMS);
$ALTERNATE_LOCALE_ROUTE = route(Route::currentRouteName(), $ALTERNATE_ROUTE_PARAMS);
$nl_link = ($locale == 'nl'?$LOCALE_ROUTE:$ALTERNATE_LOCALE_ROUTE);
$en_link = ($locale == 'en'?$LOCALE_ROUTE:$ALTERNATE_LOCALE_ROUTE);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | {{ env('APP_NAME','Default app name') }}</title>
        <link rel="alternate" hreflang="{{ $ALTERNATE_ROUTE_PARAMS['locale'] }}" href="{{ $ALTERNATE_LOCALE_ROUTE }}" />
        <link rel="stylesheet" href={{ asset('css/app.css') }}>
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a href="{{ route('home') }}" class="navbar-brand">Site</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="langselect">
                            <a href="{{ $nl_link }}" class="locale{{ ($locale=='nl' ? ' active':'') }}">NL</a> | <a href="{{ $en_link }}" class="locale{{ ($locale=='en' ? ' active':'') }}">EN</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        
        <div class="container">
            <div class="row my-5">
                @yield('content')
            </div>
        </div>
    </body>
</html>
