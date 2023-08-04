 @extends('layout/auth-layout')

 @section('main-content')
 <body class="bg-rose-600">
    <header >
        <p class="text-center text-white text-3xl mt-10 mb-8">Forgot Password 🤔</p>
    </header>
    <main class="flex items-center flex-col">
        @if ($message = Session::get('success'))
            <div class="w-80 bg-green-300 text-green-900 flex flex-col mb-4 px-7 py-3">
                {{Session::get('success')}}
            </div>
        @endif
        <form action={{route('send.password')}} method="post" class="border w-80 bg-white flex flex-col  px-7 py-5">
            @csrf
            <h2 class="font-mono text-2xl mb-2">Password Reset</h2>
            <p>Please input your email address so we can send for password reset form. Thanks 😁</p>
            <input class="my-2 border-2 rounded border-gray-400" type="email" name="email">
            <button class="text-center bg-green-500 p-2 mt-2 rounded text-white">Send Password Reset</button>
        </form>
    </main>

 @endsection

