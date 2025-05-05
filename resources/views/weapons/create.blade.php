<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Jauns Ieroči</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    
                <form action="{{ route('weapons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Ieroča nosaukums</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Apraksts</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tips</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Attēls</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary form-btn">Izveidot ieročus</button>
                </form>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
