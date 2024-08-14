@extends('component.layout')

@section('content')
    <div class="flex flex-col justify-center">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
            Akun Anda
        </h1>
        <div class="flow-root">
            <dl class="my-3 divide-y divide-gray-100 text-sm">
                <div class="grid grid-cols-1 gap-1 py-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Nomor Anda</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $email }}</dd>
                </div>

                <!-- Password Update Form -->
                <form id="update-password-form" method="POST" action="{{ route('updatePw.wali') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label for="pw" class="block mb-2 text-sm font-medium text-gray-900">Password Baru</label>
                        <input type="password" id="pw" name="pw"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div class="flex flex-row justify-end py-3">
                        <button type="submit"
                            class="inline-block rounded border border-blue-700 mx-2 px-8 py-3 text-sm font-medium text-blue-700 transition-colors hover:bg-blue-800 hover:text-white focus:ring-4 focus:ring-blue-300">
                            Ganti Pw
                        </button>
                    </div>
                </form>
            </dl>
        </div>
    </div>
@endsection
