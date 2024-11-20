<x-app-layout>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Edit Races Details</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('races.update', $race->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Races Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $race->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="feature" class="form-label">Feature</label>
                        <input type="text" class="form-control" id="feature" name="feature" value="{{ $race->feature }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{$race->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Update Race</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>



