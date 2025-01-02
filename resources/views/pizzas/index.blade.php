<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pizzas</h1>
        <a href="{{ route('pizzas.create') }}" class="btn btn-success">Create New Pizza</a>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($pizzas as $pizza)
            <div class="col">
                <x-pizza-card :pizza="$pizza"/>
            </div>
        @endforeach
    </div>
</x-layout>