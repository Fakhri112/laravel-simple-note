<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Just Notes</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="bg-teal-500 box-border">
    <header class="flex justify-between py-10 px-20">
        <p class="font-mono text-3xl text-white">My Notes 📓📔</p>
        <form action="/logout" method="post">
            @csrf
            <Button class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Log Out</Button>
        </form>
    </header>
    <main class="flex h-full gap-10 px-10" x-data="{openID: false,  titleNote: '', contentNote: ''}">
        <section class="flex-1">
            <button class="mx-4 p-1 rounded text-slate-200 bg-cyan-700 hover:bg-cyan-800" 
                    :class="openID || 'hidden' "
                    x-on:click="openID=false; titleNote=''; contentNote=''; id='' "
                    >Deselect Item</button>
           <div class="px-4 h-96 py-4 overflow-y-auto">
            @foreach($notes as $note)
            <div x-on:click="titleNote='{{$note->title}}'; contentNote='{{$note->content}}'; openID='{{$note->id}}'" 
                class="rounded px-6 py-4  mb-4" :class="(openID=='{{$note->id}}') ? 'bg-orange-300 focus:bg-orange-300 hover:bg-orange-300' : 'bg-white  hover:bg-slate-300' ">
                <p>{{$note->title}}</p>
            </div>
            @endforeach
           </div>
        </section>
        <section class="flex-1 py-4 h-max" x-data="{actionForm: '/create-note'}">
            <form :action="actionForm" method="post">
                @csrf
                <input x-on:click="console.log(open)" x-model='titleNote' name="title" class="w-full h-12 px-2 mb-4 rounded" type="text" placeholder="Notes Title">
                <textarea x-model='contentNote' class="w-full box-border h-72 px-2 py-2" name="content" placeholder="Note Content"></textarea>
                <div :class="!openID || 'hidden' ">
                    <button x-on:mouseover="actionForm='/create-note'" class="bg-green-600 text-white p-2 rounded hover:bg-green-700">Create Note</button>
                </div>
                <div :class="openID || 'hidden' ">
                    <input name='id' type="text" x-model='openID' class="hidden">
                    <button x-on:mouseover="actionForm='/update-note'" class="bg-cyan-900 text-white p-2 rounded hover:bg-cyan-950">Update Note</button>
                    <button x-on:mouseover="actionForm='/delete-note'" class="bg-rose-900 text-white p-2 rounded hover:bg-rose-950">Delete Note</button>
                </div>
            </form>
        </section>
    </main>
    <footer  class="flex justify-between px-20">
       <div class="flex items-center">
        <h1 class="text-xl italic text-white">Hello, {{auth()->user()->name}}&nbsp; </h1> 
        <p>😘</p>
       </div>
    </footer>
</body>

</html>