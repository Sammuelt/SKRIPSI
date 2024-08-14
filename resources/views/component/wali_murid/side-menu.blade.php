<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
    aria-controls="sidebar-multi-level-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="sidebar-multi-level-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
        <a href="{{ route('index.wali') }}" class="flex items-center ps-2.5 mb-5">
            <img src="https://awsimages.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=1200"
                class="h-6 me-3 sm:h-7" alt="Logo" />
            <span class="self-center text-md font-semibold whitespace-nowrap text-white">SDN 3 <br />Sungai
                Tiung</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('index.wali') }}"
                    class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-gray-900 group">
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-gray-900"
                    aria-controls="dropdown-academic" data-collapse-toggle="dropdown-academic">
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Raport</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-academic" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('wali.raport.akademik') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">Raport Akademik</a>
                    </li>
                    <li>
                        <a href="{{ route('wali.raport.proyek') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">Raport Proyek</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-gray-900"
                    aria-controls="dropdown-account" data-collapse-toggle="dropdown-account">
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Akun</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-account" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('detail.index.wali') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">Detail
                            Akun</a>
                    </li>
                    <li>
                        <a href="{{ route('ganti.pw.wali') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">Ganti
                            Password</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-gray-900">
                            @csrf
                            <button type="submit" class="w-full text-left bg-transparent border-0 focus:outline-none">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
