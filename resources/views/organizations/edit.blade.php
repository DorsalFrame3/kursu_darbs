<x-app-layout>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Rediģēt organizācijas detaļas</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('organizations.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Organizācijas nosaukums</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $organization->name }}" required>
                    </div>
                    <div class="mb-3">
                    <select id="type" name="type" class="form-control">
                            <option>Veids</option>
                            <option value="Marines" {{ $organization->type == 'Marines' ? 'selected' : '' }}>Marines</option>
                            <option value="Pirate Crews" {{ $organization->type == 'Pirate Crews' ? 'selected' : '' }}>Pirate Crews</option>
                            <option value="Seven Warlords of the Sea" {{ $organization->type == 'Seven Warlords of the Sea' ? 'selected' : '' }}>Seven Warlords of the Sea</option>
                            <option value="Four Emperors" {{ $organization->type == 'Four Emperors' ? 'selected' : '' }}>Four Emperors</option>
                            <option value="World Government" {{ $organization->type == 'World Government' ? 'selected' : '' }}>World Government</option>
                            <option value="Revolutionary Army" {{ $organization->type == 'Revolutionary Army' ? 'selected' : '' }}>Revolutionary Army</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Apraksts</label>
                        <textarea class="form-control" name="description" id="description">{{ $organization->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Attēls</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Atjaunināt organizāciju</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
