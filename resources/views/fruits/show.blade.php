<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Fruit Details: {{ $fruit->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $fruit->name }}</p>
                        <p><span>Type:</span> {{ $fruit->type }}</p>
                        <p><span>Power:</span> {{ $fruit->power }}</p>
                        @if ($fruit->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $fruit->image) }}" alt="{{ $fruit->name }}" class="fruit-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $fruit->description }}</p>
                    </div>
                </div>

                
                <div class="mt-4 text-center">
                    <a href="{{ route('fruits.index') }}" class="btn btn-primary">Back to the List</a>
                    @can('upd-del-fruit', $fruit)
                        <a href="{{ route('fruits.edit', $fruit->id) }}" class="btn btn-secondary">Edit Fruit</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>