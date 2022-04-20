{{-- php artisan make:component Alert --}}
@if (session()->has('message'))
    <div class="py-4 px-2 bg-green-300" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

@if ($errors->any())
    <div class="py-4 px-2 bg-red-300" role="alert">
        <ul>
            @foreach ($errors->all() as $erroritem)
                <li>{{ $erroritem }}</li>
            @endforeach
        </ul>
    </div>
@endif