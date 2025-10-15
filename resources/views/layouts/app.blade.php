<?php
use App\Models\Setting;
use App\Models\Menu;
use App\Models\ContactInfo;
$info = ContactInfo::first();
$settings = Setting::first();
$activeMenus = Menu::where('status', 'Active')->get();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/x-icon">
    <title>@yield('title', 'MIS Alumni - Modern Indian School Alumni Network')</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/styles.css') }}">
    @stack('styles')
</head>

<body>
    @include('layouts.partials.frontend.navigation')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.frontend.footer')

    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    @stack('scripts')\
</body>

</html>
