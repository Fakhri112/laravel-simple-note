@extends('layout/auth-layout')

@section('main-content')
<body class="bg-violet-500">
    <header>
        <p class="text-center text-white text-3xl mt-10 mb-8">Welcome 😉</p>
    </header>
    <main class="flex items-center flex-col">
        @if ($message = Session::get('error'))
            <div class="w-80 bg-red-300 text-red-900 flex flex-col mb-4 px-7 py-3">
                {{Session::get('error')}}
            </div>
        @endif
        <form action="/signin" method="post" class="border w-80 bg-white flex flex-col items-center px-7 py-5">
            @csrf
            <h2 class="font-mono text-2xl mb-2">Sign In</h2>
            <div class="w-full mb-2">
                <label for="email">Email</label>
                <input name="email" class="border-2 border-gray-400 rounded w-full block" type="text" id="email">
            </div>
            <div class="w-full">
                <label for="pw">Password</label>
                <input name="password" class=" w-full block border border-2 border-gray-400 rounded" type="password" id="pw">
            </div>
            <button class="text-center bg-green-500 p-2 mt-10 rounded text-white">Sign in</button>
            <a class="font-semibold mt-5 text-fuchsia-950 hover:text-fuchsia-600" href="/forgot-password">Forgot Password</a>
            <a class="font-semibold mt-5 text-fuchsia-950 hover:text-fuchsia-600" href="/register">Create Account</a>
        </form>
    </main>
    @endsection