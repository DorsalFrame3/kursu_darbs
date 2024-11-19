<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">New Location</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    
                <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Location Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <select id="region" name="region" class="form-control">
                            <option>Region</option>
                            <option value="East Blue">East Blue</option>
                            <option value="West Blue">West Blue</option>
                            <option value="North Blue">North Blue</option>
                            <option value="South Blue">South Blue</option>
                            <option value="Red Line">Red Line</option>
                            <option value="Calm Belt">Calm Belt</option>
                            <option value="Grand Line">Grand Line</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary form-btn">Create Location</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
