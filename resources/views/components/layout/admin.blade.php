<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} : {{ config('app.name') }} {{config('admin.version')}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('iconsax/iconsax.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}">
    @stack('css')
</head>

<body class="bg-[#FCE6D1]" x-data="{ sidebarCollapse: false, collapseMenu: false,crudForm:false,filterForm:false,importPopup:false }" x-bind:class="sidebarCollapse ? 'sidebar-collapse' : 'sidebar-hide'">
    <main class="font-krub-regular">
        <x-alert.confirmation />
        <x-layout.sidebar />
        <section class="w-full ps-sidebar app-wrapper ">
            <x-layout.header :title="$title" :breadcrumb="@$breadcrumb" />
            <section class="overflow-auto ">
                @stack('pre_html')
                {{ $slot }}
            </section>
        </section>
        @if (session('message'))
            <x-alert :message="session('message')" :type="session('message_type')" />
        @endif
        @stack('html')
        <span class="border-[#EA120C]"></span>
    </main>
    <script src="{{ asset('assets/js/app.js?v='.date('YmdHis')) }}"></script>
    <script defer src="{{asset('assets/js/alpine-anchor.js')}}"></script>
    <script defer src="{{asset('assets/js/alpinejs.js')}}"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    @stack('js')
</body>

</html>
