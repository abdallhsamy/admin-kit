<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('vendor_style')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('page_style')
    <script src="{{ mix('js/app.js') }}"></script>
    <title>@yield('page_title')</title>
</head>
<body>
<div class="h-screen flex overflow-hidden bg-gray-100">
    @include('layouts.partials.mobile_sidebar')
    @include('layouts.partials.desktop_sidebar')
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        @include('layouts.partials.navbar')

        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900">@yield('page_title')</h1>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</div>
@yield('vendor_script')
@yield('page_script')
</body>
</html>
