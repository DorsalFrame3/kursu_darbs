<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Rediģēt ieroču datus</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('weapons.update', $weapon->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Ieroča nosaukums</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $weapon->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Apraksts</label>
                        <textarea class="form-control" name="description" id="description">{{$weapon->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tips</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{ $weapon->type }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Attēls</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Atjaunināt ieročus</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
