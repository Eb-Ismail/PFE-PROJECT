@props(['publication'])

<div class="card my-4 bg-light border border-dark">
    <div class="card-body">
        @can('update', $publication)
        <a class="float-end btn btn-sm btn-outline-primary" href="{{ route('publications.edit', $publication->id) }}">Modifier</a>
        @endcan
        @can('delete', $publication)
        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Voulez-vous vraiment supprimer?')" class="float-end btn btn-sm btn-outline-danger mx-2">Supprimer</button>
        </form>
        @endcan

        <blockquote class="blockquote mb-0">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $publication->profile->image) }}" width="100px" class="rounded-circle my-2 border border-dark" alt="{{ $publication->profile->name }}">
                        <p class="text-muted small mb-0">{{ $publication->profile->name }}</p>
                        <a href="{{ route('profiles.show', $publication->profile->id) }}" class="stretched-link"></a>
                    </div>
                </div>
                <div class="col">
                    <h5 class="card-title mb-0">{{ $publication->title }}</h5>
                    <p class="card-text text-muted small mb-1">{{ $publication->created_at->format('d-m-Y') }}</p>
                    <p class="card-text">{{ $publication->body }}</p>
                    @if (!is_null($publication->image))
                    <img class="img-fluid mt-3 border border-dark" src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}">
                    @endif
                </div>
            </div>
        </blockquote>
    </div>
</div>
