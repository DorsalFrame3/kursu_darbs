<x-app-layout>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Edit Locations Details</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('locations.update', $location->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Locations Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $location->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{ $location->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <select id="region" name="region" class="form-control">
                            <option>Region</option>
                            <option value="East Blue"{{ $location->region == 'East Blue' ? 'selected' : '' }}>East Blue</option>
                            <option value="West Blue"{{ $location->region == 'West Blue' ? 'selected' : '' }}>West Blue</option>
                            <option value="North Blue"{{ $location->region == 'North Blue' ? 'selected' : '' }}>North Blue</option>
                            <option value="South Blue"{{ $location->region == 'South Blue' ? 'selected' : '' }}>South Blue</option>
                            <option value="Red Line"{{ $location->region == 'Red Line' ? 'selected' : '' }}>Red Line</option>
                            <option value="Calm Belt"{{ $location->region == 'Calm Belt' ? 'selected' : '' }}>Calm Belt</option>
                            <option value="Grand Line"{{ $location->region == 'Grand Line' ? 'selected' : '' }}>Grand Line</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Update Location</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>



