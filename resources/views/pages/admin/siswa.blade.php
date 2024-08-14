@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Data Siswa</h2>
            </header>
        </div>
        
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 my-4">
            <div class="rounded-lg bg-gray-200">
                <a class="group flex items-center justify-between gap-4 rounded-lg border border-blue-700 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-5 py-3 transition-colors"
                    href="{{ route('create.siswa') }}">
                    <span class="font-medium text-white transition-colors group-active:text-blue-600">
                        Tambahkan Data Siswa
                    </span>
                    <span
                        class="shrink-0 rounded-full border border-current bg-white p-2 text-blue-700 group-active:text-blue-600">
                        <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan pilih kelas..
        </p>

        {{-- btn group kelas --}}
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
            @foreach($kelas as $kls)
            <div class="h-fit rounded-lg">
                <article class="rounded-lg border border-gray-100 bg-white p-4 shadow-sm transition hover:shadow-lg sm:p-6">
                    <span class="inline-block rounded bg-blue-600 p-2 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </span>
                    <h3 class="mt-0.5 text-lg font-medium text-gray-900">
                        {{ $kls->nama_kelas }}
                    </h3>

                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                        Wali kelas : {{ $kls->walikelas ? $kls->walikelas->nama : 'Belum ada walikelas' }}
                    </p>

                    <a href="{{ route('index.siswa.kelas', ['id_kelas' => $kls->id]) }}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
                        Lihat data siswa
                        <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                            &rarr;
                        </span>
                    </a>

                </article>
            </div>
            @endforeach
        </div>
    </div>
@endsection
