<x-app-layout>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Edit Characters Details</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('characters.update', $character->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Characters Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $character->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{ $character->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bounty" class="form-label">Bounty (in Berries)</label>
                        <input type="number" class="form-control" id="bounty" name="bounty" value="{{ $character->bounty }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fruit_id">Fruit:</label>
                        <select name="fruit_id">
                            <option value="">None</option>
                            @foreach($fruits as $fruit)
                                <option value="{{ $fruit->id }}" 
                                    {{ isset($character) && $character->fruit_id == $fruit->id ? 'selected' : '' }}>
                                    {{ $fruit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="weapon_id">Weapon:</label>
                        <select name="weapon_id">
                            <option value="">None</option>
                            @foreach($weapons as $weapon)
                                <option value="{{ $weapon->id }}" 
                                    {{ isset($character) && $character->weapon_id == $weapon->id ? 'selected' : '' }}>
                                    {{ $weapon->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location_id">Location:</label>
                        <select name="location_id">
                            <option value="">None</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" 
                                    {{ isset($character) && $character->location_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="organization_id">Organization:</label>
                        <select name="organization_id">
                            <option value="">None</option>
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}" 
                                    {{ isset($character) && $character->organization_id == $organization->id ? 'selected' : '' }}>
                                    {{ $organization->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="race_id">Race:</label>
                        <select name="race_id">
                            <option value="">None</option>
                            @foreach($races as $race)
                                <option value="{{ $race->id }}" 
                                    {{ isset($character) && $character->race_id == $race->id ? 'selected' : '' }}>
                                    {{ $race->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary form-btn">Update Characters</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>

