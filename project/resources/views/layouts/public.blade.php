<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('metaDescription')">
        
        @yield('socialMediaMeta')
        {{-- These social media metatags are consistent across all pages --}}
        <meta property="og:image" content="{{$socialLogo ?? asset('images/logo_image_only.png')}}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta name="twitter:card" content="{{$socialLogo ?? asset('images/logo_image_only.png')}}">
        
        <link rel="icon" type="image/png" href="favicon.png">

        <title>@yield('title')</title>
        
        <link href="{{ asset('css/publicStyle.css') }}" type="text/css" rel="stylesheet">
        <link href="@yield('secondaryStyleSheet')" type="text/css" rel="stylesheet">
        
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div class="container-fluid">
            <div class="col-md-8 offset-md-4 col-10 offset-2" id="contentContainer">
                @yield("content")
            </div>
        </div>
        
    </body>
</html>
