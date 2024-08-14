@extends('component.layout')

@section('content')
    <!-- content -->

    <div class="flex flex-col justify-center">
        @include('component.jumbotron')
        <br>
        <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
            Kalender Akademik
        </h1>
        <a  href="{{ route('create.kalender') }}"
            class="text-white bg-[#1da1f2] hover:bg-[#1da1f2]/90 focus:ring-4 focus:outline-none focus:ring-[#1da1f2]/50 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 mb-2">
            Tambahkan Aktivitas Baru
        </a>


        @include('component.dashboard-content')

    </div>

    <!-- end content -->
@endsection
