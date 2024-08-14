<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISTEM INFORMASI MANAGEMENT SDN 3 SUNGAI TIUNG</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body>
    {{-- side-menu berdasarkan role --}}
    @if (Auth::check())
        @if (strcasecmp(Auth::user()->role, 'admin') == 0)
            @include('component.admin.side-menu')
        @elseif (strcasecmp(Auth::user()->role, 'user') == 0)
            @include('component.user.side-menu')
        @else
            @include('component.wali_murid.side-menu')
        @endif
    @endif

    {{-- end side-menu --}}

    {{-- content here --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
