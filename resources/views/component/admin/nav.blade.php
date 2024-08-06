<header class="bg-white">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex h-16 items-center justify-between">
            <div class="flex-1 md:flex md:items-center md:gap-12">
            </div>
            <div class="md:flex md:items-center md:gap-12">
                <div class="flex items-center gap-4">
                    <div class="sm:flex sm:gap-4">
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">
                            @csrf
                            <button type="submit" class="w-full text-left bg-transparent border-0 focus:outline-none">
                                Logout
                            </button>
                        </form>
                    </div>

                    <div class="block md:hidden">
                        <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
