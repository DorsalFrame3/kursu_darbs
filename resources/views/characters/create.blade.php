<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Jauns varonis</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        
                <form action="{{ route('characters.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Vārds</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Apraksts</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bounty" class="form-label">Balva (Berrijos)</label>
                        <input type="number" class="form-control" id="bounty" name="bounty" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Attēls</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="fruit_id">Velna auglis:</label>
                        <select name="fruit_id">
                            <option value="">Nav</option>
                            @foreach($fruits as $fruit)
                                <option value="{{ $fruit->id }}" 
                                    {{ isset($character) }}>
                                    {{ $fruit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="weapon_id">Ieroči:</label>
                        <select name="weapon_id">
                            <option value="">Nav</option>
                            @foreach($weapons as $weapon)
                                <option value="{{ $weapon->id }}" 
                                    {{ isset($character) }}>
                                    {{ $weapon->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location_id">Dzimšanas vieta:</label>
                        <select name="location_id">
                            <option value="">Nav</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" 
                                    {{ isset($character) }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="organization_id">Organizācija:</label>
                        <select name="organization_id">
                            <option value="">Nav</option>
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}" 
                                    {{ isset($character) }}>
                                    {{ $organization->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="race_id">Rase:</label>
                        <select name="race_id">
                            <option value="">Nav</option>
                            @foreach($races as $race)
                                <option value="{{ $race->id }}" 
                                    {{ isset($character) }}>
                                    {{ $race->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary form-btn">Izveidot varoni</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
