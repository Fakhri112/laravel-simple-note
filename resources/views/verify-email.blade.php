@extends('layout/auth-layout')

@section('main-content')
<body class="bg-indigo-600">
    <header >
        <p class="text-center text-white text-3xl mt-10 mb-8">Alert ❗❗</p>
    </header>
    <main class="flex items-center flex-col">
        @if ($message = Session::get('success'))
            <div class="w-80 bg-green-300 text-green-900 flex flex-col mb-4 px-7 py-3">
                {{Session::get('success')}}
            </div>
        @endif
        <form action={{route('verification.resend')}} method="post" class="border w-80 bg-white flex flex-col  px-7 py-5">
            @csrf
            <h2 class="font-mono text-2xl mb-2">Verify Email</h2>
            <p>Please verify your email address by clicking the link in the mail we just sent you. Thanks!</p>
            <button class="text-center bg-green-500 p-2 mt-10 rounded text-white">Resend Email</button>
        </form>
    </main>
@endsection