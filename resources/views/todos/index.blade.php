<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
      rel="stylesheet">
    <title>Todo list</title>
</head>
<body>
    <div class="text-center pt-10">
        <h1 class="text-2xl">What next you need To-DO</h1>
<x-Alert/>
    <form action="/todos/create" method="post" class="py-5">
        @csrf
    <input type="text" name="title" class="py-3 px-2 border rounded">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">Create</button>
</form></div>
</body>
</html>