<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Atrašanās vietas detaļas: {{ $location->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Nosaukums:</span> {{ $location->name }}</p>
                        <p><span>Reģions:</span> {{ $location->region }}</p>
                        @if ($location->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="location-image">
                            </div>
                        @endif
                    </div>

                    <div class="details-right">
                        <p><span>Apraksts:</span> {{ $location->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    @if(in_array($location->id, $favoriteLocationIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'locations', 'id' => $location->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'locations']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $location->id }}">
                                <button type="submit" class="btn btn-success ">Pievienot izlasē</button>
                            </form>
                        @endif

                    <a href="{{ route('locations.index') }}" class="btn btn-primary">Atpakaļ uz sarakstu</a>
                    
                    @can('upd-del-location', $location)
                        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-secondary">Rediģēt atrašanās vietu</a>
                    @endcan
                </div>
                <div class="comments-section mt-5">
                    <h3 class="sub-header">Komentāri</h3>

                    @foreach ($location->comments as $comment)
                        <div class="comment card mb-3">
                            <div class="card-body">
                                <p class="card-text">{{ $comment->content }}</p>
                                <small class="text-muted">
                                    <strong> {{ $comment->user->name }}</strong>
                                    <br>
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>

                                @can('delete', $comment)
                                    <div class="d-flex justify-content-end">
                                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Dzēst</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                    @auth
                        <form method="POST" action="{{ route('comments.store', ['type' => 'location', 'id' => $location->id]) }}">
                            @csrf
                            <textarea name="content" class="form-control" placeholder="Pievienot komentāru..." required></textarea>
                            <button type="submit" class="btn btn-success mt-2">Pievienot komentāru</button>
                        </form> 
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
