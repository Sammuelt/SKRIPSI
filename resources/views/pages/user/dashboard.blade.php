@extends('component.layout')

@section('content')
    <!-- content -->

    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Kalender Akademik
        </h1>
      


        @include('component.dashboard-content')

    </div>

    <!-- end content -->
@endsection
