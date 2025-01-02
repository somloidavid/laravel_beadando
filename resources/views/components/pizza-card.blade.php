@props(['pizza'])

<div class="card h-100">
    <div class="card-body d-flex flex-column">
        <img src="{{ $pizza->image }}" alt="{{ $pizza->name }}" class="img-fluid mb-2" style="object-fit: cover; height: 200px; width: 100%;">
        <h5 class="card-title">{{ $pizza->name }}</h5>
        <p class="card-text">
            Price: ${{ $pizza->price }}
            @if($pizza->topping_names)
                <br>Toppings: {{ $pizza->topping_names }}
            @endif
        </p>
        <div class="mt-auto d-flex gap-2">
            <a href="{{ route('pizzas.edit', $pizza->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('pizzas.destroy', $pizza->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>