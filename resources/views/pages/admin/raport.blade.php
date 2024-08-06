@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 md:text-5xl lg:text-6xl">Data Raport</h2>
                {{-- <p class="my-4 text-lg font-normal text-gray-500 lg:text-xl">
                    Silahkan Pilih Jenis Raport
                </p> --}}
            </header>
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
                        Wali kelas : {{ $kls->walikelas ? $kls->walikelas->nama : 'belum ada walikelas' }}
                    </p>

                    <a href="{{ route('index.raport.kelas', ['id_kelas' => $kls->id]) }}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600">
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
