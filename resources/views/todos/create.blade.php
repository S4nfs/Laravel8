@extends('todos/layout')
@section('content')
    <div class="text-center py-10 flex justify-center items-center h-screen">
        <div class="text-center py-10 ">
        <h1 class="text-4xl">What next you need To-DO</h1>
        <x-Alert />
        <form action="/todos/create" method="post" class="py-5">
            @csrf
            <input type="text" name="title" class="py-3 px-2 border rounded">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 ml-5 rounded-full"
                type="submit">Create</button>
        </form>
        <a href="/todos"><button class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-bold py-2 px-4 rounded-full mt-5" type="submit">Back</button></a>
        </div>
    </div>
@endsection
