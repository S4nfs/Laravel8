@extends('todos/layout')
@section('content')
    <div class="flex justify-center">
        <div class="text-center pt-10">
            <h1 class="text-2xl">All your To-DOs</h1>
            <x-Alert />
            <a href="/todos/create"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-5" type="submit">Create new</button></a>
        </div>
    </div>
        <div class="h-screen flex items-center justify-center bg-gray-100">
            <div class="grid grid-cols-12 max-w-5xl gap-12">
                @foreach ($mytodos as $items)
                    <!-- Card 1 -->
                <div class="grid col-span-4 relative">
                        <a class="group shadow-lg hover:shadow-2xl duration-200 delay-75 w-full bg-white rounded-sm py-6 pr-6 pl-9"
                            href="{{'/todos/'.$items->id.'/edit'}}">

                            <!-- Title -->
                            <p class="text-2xl font-bold text-gray-500 group-hover:text-gray-700"></p>

                            <!-- Description -->
                            <p class="text-sm font-semibold text-500 group-hover:text-gray-700 mt-2 leading-6 px-8">
                                {{ $items->title }} </p></a>

                            <!-- Color -->
                            @if($items->completed)
                            <span onclick="event.preventDefault();document.getElementById('form-incomplete-{{$items->id}}').submit()" class="bg-green-400 group-hover:bg-green-600 h-full w-4 absolute top-0 left-0"> </span>

                            <form action="{{'/todos/'.$items->id.'/incomplete'}}" style="display:none" method="post" id="{{'form-incomplete-'.$items->id}}">
                                @csrf
                                @method('delete')
                            </form>

                            @else
                            <span onclick="event.preventDefault();document.getElementById('form-complete-{{$items->id}}').submit()" class="bg-blue-400 group-hover:bg-blue-600 h-full w-4 absolute top-0 left-0"> </span>

                            <form action="{{'/todos/'.$items->id.'/complete'}}" style="display:none" method="post" id="{{'form-complete-'.$items->id}}">
                                @csrf
                                @method('put')
                            </form>
                            @endif
                        
                    </div>
                @endforeach
            </div>
        </div>

@endsection
