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
    <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon">
    @stack('css')
</head>

<body class="bg-[#FCE6D1]">
    <main class="font-krub-regular h-screen flex flex-col items-center justify-center">
        {{ $slot }}
    </main>
    <script defer src="{{asset('assets/js/alpinejs.js')}}"></script>
    <script>
        document.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                form.querySelectorAll('button[type="submit"]').forEach((button) => {
                    button.setAttribute('disabled', true)
                })
            })
        })
    </script>
</body>

</html>
