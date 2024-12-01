<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Weapon Details: {{ $weapon->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $weapon->name }}</p>
                        <p><span>Type:</span> {{ $weapon->type }}</p>
                        @if ($weapon->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $weapon->image) }}" alt="{{ $weapon->name }}" class="weapon-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $weapon->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                @if(in_array($race->id, $favoriteRaceIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'races', 'id' => $race->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'races']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $race->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                    <a href="{{ route('weapons.index') }}" class="btn btn-primary">Back to the List</a>
                    
                    @can('upd-del-weapon', $weapon)
                        <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-secondary">Edit Weapon</a>
                    @endcan
                </div>
                    <div class="comments-section mt-5">
                    <h3 class="sub-header">Comments</h3>

                    @foreach ($weapon->comments as $comment)
                        <div class="comment card mb-3">
                            <div class="card-body">
                                <p class="card-text">{{ $comment->content }}</p>
                                <small class="text-muted">
                                    <strong> {{ $comment->user->name }}</strong>
                                    <br>
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>

                                @if(auth()->id() === $comment->user_id)
                                    <div class="d-flex justify-content-end">
                                        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>

                                @endif
                            </div>
                        </div>
                    @endforeach
                    @auth
                        <form method="POST" action="{{ route('comments.store', ['type' => 'weapon', 'id' => $weapon->id]) }}">
                            @csrf
                            <textarea name="content" class="form-control" placeholder="Add a comment..." required></textarea>
                            <button type="submit" class="btn btn-success mt-2">Add Comment</button>
                        </form> 
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>