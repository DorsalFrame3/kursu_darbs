<x-app-layout>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Edit Devil Fruits Details</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('fruits.update', $fruit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Devil Fruits Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $fruit->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{ $fruit->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <select id="type" name="type" class="form-control" >
                            <option>Type</option>
                            <option value="Logia"{{ $fruit->type == 'Logia' ? 'selected' : '' }}>Logia</option>
                            <option value="Zoan"{{ $fruit->type == 'Zoan' ? 'selected' : '' }}>Zoan</option>
                            <option value="Paramecia"{{ $fruit->type == 'Paramecia' ? 'selected' : '' }}>Paramecia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="power" class="form-label">Power</label>
                        <input type="text" class="form-control" id="power" name="power" value="{{ $fruit->power }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Update Fruits</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>

