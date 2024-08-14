@extends('component.layout')

@section('content')
    <!-- content -->

    <div class="flex flex-col justify-center">
        @include('component.wali_murid.jumbotron-wali')
        <br>
        <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
            Kalender Akademik
        </h1>

        @include('component.dashboard-content')

    </div>

    <!-- end content -->
@endsection
