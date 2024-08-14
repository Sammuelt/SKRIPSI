<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WELCOME: SISTEM INFORMASI MANAGEMENT SDN 3 SUNGAI TIUNG</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body>
    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <section class="relative flex h-32 items-end bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6">
              <img src="{{ asset('assets/bg-log.jpg') }}"
                    class="absolute inset-0 h-full w-full object-cover opacity-80" />

                <div class="hidden lg:relative lg:block lg:p-12">
                    <a class="inline-flex size-16 items-center justify-center rounded-full bg-white text-blue-600 sm:size-20"
                        href="#">
                        <img src="https://awsimages.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=1200"
                            class="h-10 sm:h-11" alt="Logo" />
                    </a>

                    <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                        Selamat Datang..
                    </h2>

                    <p class="mt-4 leading-relaxed text-white/90">
                        SD Negeri 3 Sungai Tiung
                    </p>
                    <p class="mt-4 leading-relaxed text-white/90">
                        Jln. Transpol Cempaka RT/RW 33/11 ,Sungai Tiung,<br> Kec. Cempaka,Kota Banjarbaru, 70734
                    </p>
                    
                </div>
            </section>

            <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">
                    <div class="relative -mt-16 block lg:hidden">
                        <a class="inline-flex size-16 items-center justify-center rounded-full bg-white text-blue-600 sm:size-20"
                            href="#">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=1200"
                                class="h-10 sm:h-11" alt="Logo" />
                        </a>

                        <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                            Selamat Datang
                        </h1>

                        <p class="mt-4 leading-relaxed text-gray-500">
                            Silahkan login untuk melanjutkan..
                        </p>
                    </div>

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4">
                            <div class="text-sm text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('auth') }}" class="mt-8 grid grid-cols-12 gap-6">
                        @csrf

                        <div class="col-span-12">
                            <label for="Email" class="block text-sm font-medium text-gray-700">
                                Email/ No Hp (untuk wali murid)
                            </label>

                            <input type="text" id="Email" name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12">
                            <label for="Password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>

                            <input type="password" id="Password" name="password"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-8">
                            <p class="text-sm text-gray-500">
                                By logging into an account, you agree to our
                                <a href="#" class="text-gray-700 underline">
                                    terms and conditions
                                </a>
                                and
                                <a href="#" class="text-gray-700 underline">privacy policy</a>.
                            </p>
                        </div>

                        <div class="col-span-4 sm:flex sm:items-center sm:gap-4">
                            <button type="submit"
                                class="inline-block w-full shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                Login
                            </button>
                        </div>
                    </form> 
                </div>
            </main>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
