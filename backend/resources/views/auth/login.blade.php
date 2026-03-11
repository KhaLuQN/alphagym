@extends('auth.layout')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-base-200">
        <div class="w-full max-w-md shadow-xl rounded-xl bg-base-100">

            <form method="POST" action="{{ route('login.send') }}" class="p-6 space-y-4">
                @csrf
                <div class="p-6 bg-primary text-primary-content rounded-t-xl text-center">
                    <h3 class="text-2xl font-bold">Đăng Nhập Bằng Email</h3>
                    <p class="text-sm">Phần mềm quản lý phòng Gym</p>
                </div>
                <div class="flex bg-indigo-700 p-3">
                    <div class="w-full max-w-xs m-auto bg-indigo-100 rounded p-5">
                        <header>
                            <img class="w-20 mx-auto mb-5" src="{{ asset('images/admin.png') }}" />
                        </header>
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div>
                            <label class="block mb-2 text-indigo-500" for="email">Email</label>
                            <input
                                class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300"
                                type="email" name="email" id="email" placeholder="Nhập email của bạn" required autofocus>
                        </div>
                        <div>
                            <button
                                class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded"
                                type="submit">Gửi Link Đăng Nhập</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection