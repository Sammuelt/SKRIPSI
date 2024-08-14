@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Tambahkan Akun Baru
        </h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl">
            Silahkan isi form dibawah ini dengan baik dan benar!!
        </p>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('store.akun') }}">
            @csrf

            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                <select id="role" name="role"
                    class="w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between">
                    <option value="">--PILIH ROLE--</option>
                    <option value="user">Guru</option>
                    <option value="wali">Wali Murid</option>
                </select>
            </div>

            <div class="mb-6" id="guru-container" style="display: none;">
                <label for="guru" class="block mb-2 text-sm font-medium text-gray-900">Pilih Guru</label>
                <select
                    class="form-control w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between"
                    id="guru" name="guru_id">
                    <option value="">--PILIH GURU--</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" data-email="{{ $user->email }}">{{ strtoupper($user->nama) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6" id="wali-container" style="display: none;">
                <label for="wali" class="block mb-2 text-sm font-medium text-gray-900">Pilih Wali Murid</label>
                <select
                    class="form-control w-full text-gray-900 bg-gray-50 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-left justify-between"
                    id="wali" name="wali_id">
                    <option value="">--PILIH WALI--</option>
                    @foreach ($wali as $user)
                        <option value="{{ $user->id }}" data-email="{{ $user->no_hp_ortu }}">
                            {{ strtoupper($user->nama_lengkap) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6" id="email-container" style="display: none;">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="text" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
            </div>

            <div class="mb-6" id="phone-container" style="display: none;">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">No Hp</label>
                <input type="text" id="phone" name="phone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
            </div>

            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="corrected" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                        required />
                </div>
                <label for="corrected" class="ms-2 text-sm font-medium text-gray-900">Pastikan anda sudah
                    memasukan data dengan benar!!</label>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            var role = this.value;
            var guruContainer = document.getElementById('guru-container');
            var waliContainer = document.getElementById('wali-container');
            var emailContainer = document.getElementById('email-container');
            var phoneContainer = document.getElementById('phone-container');

            if (role === 'user') {
                guruContainer.style.display = 'block';
                waliContainer.style.display = 'none';
                emailContainer.style.display = 'block';
                phoneContainer.style.display = 'none';
            } else if (role === 'wali') {
                guruContainer.style.display = 'none';
                waliContainer.style.display = 'block';
                emailContainer.style.display = 'none';
                phoneContainer.style.display = 'block';
            } else {
                guruContainer.style.display = 'none';
                waliContainer.style.display = 'none';
                emailContainer.style.display = 'none';
                phoneContainer.style.display = 'none';
            }
        });

        document.getElementById('guru').addEventListener('change', function() {
            var email = this.options[this.selectedIndex].getAttribute('data-email');
            document.getElementById('email').value = email ? email : '';
        });

        document.getElementById('wali').addEventListener('change', function() {
            var phone = this.options[this.selectedIndex].getAttribute('data-email');
            document.getElementById('phone').value = phone ? phone : '';
        });

        document.querySelector('form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                event.preventDefault(); // Mencegah form submit
                alert('PASSWORD DAN KONFIRMASI PASSWORD HARUS SAMA');
            }
        });
    </script>
@endsection
