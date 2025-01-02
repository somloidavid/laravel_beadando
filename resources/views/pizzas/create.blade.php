<x-layout>
    <h1>Create New Pizza</h1>

    <form action="{{ route('pizzas.store') }}" method="POST" class="mt-4">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                   id="price" name="price" value="{{ old('price') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" 
                   id="image" name="image" value="{{ old('image') }}" required>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Toppings</label>
            @foreach($toppings as $topping)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="toppings[]" 
                           value="{{ $topping->id }}" id="topping{{ $topping->id }}"
                           {{ in_array($topping->id, old('toppings', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="topping{{ $topping->id }}">
                        {{ $topping->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create Pizza</button>
            <a href="{{ route('pizzas.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</x-layout>