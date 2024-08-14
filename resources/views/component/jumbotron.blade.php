<section class="relative overflow-hidden bg-gray-700 bg-blend-multiply rounded-xl">
    <div class="relative w-full h-80 overflow-hidden">
        <div id="carousel" class="flex transition-transform duration-500 ease-in-out w-full h-full">
            @if($prestasi->isEmpty())
                <div class="relative w-full h-full min-w-full flex items-center justify-center">
                    <div class="relative px-4 mx-auto max-w-screen-xl text-center py-12 lg:py-28">
                        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                            <a href="{{ route('prestasi.index') }}" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">Learn more</a>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($prestasi as $item)
                <div class="relative w-full h-full min-w-full flex items-center justify-center">
                    <div class="absolute inset-0 bg-center bg-no-repeat bg-cover bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')]"></div>
                    <div class="relative px-4 mx-auto max-w-screen-xl text-center py-12 lg:py-28">
                        <h1 class="mb-2 text-3xl font-extrabold tracking-tight leading-none text-white md:text-4xl lg:text-5xl">{{ $item->siswa->nama_lengkap ?? '' }}</h1>
                        <p class="mb-2 text-lg font-bold text-gray-300 lg:text-xl sm:px-16 lg:px-48">{{$item->title}}{{$item->sub}}</p>
                        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Selamat kepada {{$item->siswa->nama_lengkap}}, {{$item->ket}}, pada "{{$item->date}}".</p>
                        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                            <a href="{{ route('prestasi.index') }}" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">Learn more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<script>
    const carousel = document.getElementById('carousel');
    let currentIndex = 0;
    const totalItems = carousel.children.length;

    function scrollCarousel() {
        currentIndex = (currentIndex + 1) % totalItems;
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(scrollCarousel, 5000); // Scroll every 5 seconds
</script>
