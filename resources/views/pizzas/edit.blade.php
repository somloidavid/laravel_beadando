<x-layout>
    <h1>Edit Pizza</h1>

    <form action="{{ route('pizzas.update', $pizza->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $pizza->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $pizza->price }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="image" name="image" value="{{ $pizza->image }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Toppings</label>
            @foreach($toppings as $topping)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="toppings[]" 
                           value="{{ $topping->id }}" id="topping{{ $topping->id }}"
                           {{ in_array($topping->id, $pizzaToppings) ? 'checked' : '' }}>
                    <label class="form-check-label" for="topping{{ $topping->id }}">
                        {{ $topping->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Pizza</button>
            <a href="{{ route('pizzas.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</x-layout>