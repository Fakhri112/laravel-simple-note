@extends('layout/auth-layout')

@section('main-content')
<body class="bg-rose-600">
   <header >
       <p class="text-center text-white text-3xl mt-10 mb-8">👇 Password Reset 👇</p>
   </header>
   <main class="flex justify-center ">
       <form action={{route('change.password')}} method="post" class="border w-80 bg-white flex flex-col  px-7 py-5">
           @csrf
           <h2 class="font-mono text-2xl mb-2">Enter New Password</h2>
           <input class="hidden" type="email" name="email" id="" value={{$email}}>
        <div class="w-full mb-2">
            <label for="pw">Password</label>
            <input name="password" class=" w-full block border border-2 border-gray-400 rounded" type="password" id="pw">
        </div>
        <div class="w-full mb-2">
            <label for="pwconf">Confirm Password</label>
            <input name="password_confirmation" class=" w-full block border border-2 border-gray-400 rounded" type="password" id="pwconf">
        </div>
           <button class="text-center bg-green-500 p-2 mt-2 rounded text-white">Change Password</button>
       </form>
   </main>

@endsection

