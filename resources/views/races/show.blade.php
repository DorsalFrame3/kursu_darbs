<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Rases detaļas: {{ $race->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Nosaukums:</span> {{ $race->name }}</p>
                        <p><span>Īpašība:</span> {{ $race->feature }}</p>
                        @if ($race->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $race->image) }}" alt="{{ $race->name }}" class="race-image">
                            </div>
                        @endif
                    </div>
                    <div class="details-right">
                        <p><span>Apraksts:</span> {{ $race->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    @if(in_array($race->id, $favoriteRaceIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'races', 'id' => $race->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                    @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'races']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $race->id }}">
                                <button type="submit" class="btn btn-success ">Pievienot izlasē</button>
                            </form>
                    @endif

                    <a href="{{ route('races.index') }}" class="btn btn-primary">Atpakaļ uz sarakstu</a>
                    
                    @can('upd-del-race', $race)
                        <a href="{{ route('races.edit', $race->id) }}" class="btn btn-secondary">Rediģēt rasi</a>
                    @endcan
                </div>
                <div class="comments-section mt-5">
                    <h3 class="sub-header">Komentāri</h3>

                    @foreach ($race->comments as $comment)
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
                        <form method="POST" action="{{ route('comments.store', ['type' => 'race', 'id' => $race->id]) }}">
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
