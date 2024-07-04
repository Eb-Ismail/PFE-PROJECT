<x-master title="Profile">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 py-4" style="background-color: #f0f0f0; border: 1px solid #343a40;">
                    <img src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->name }}" class="card-img-top w-25 mx-auto border border-dark rounded-circle">
                    <div class="card-body text-center">
                        <p class="card-text">{{ $profile->created_at->format('d-m-Y') }}</p>
                        <h4 class="card-title">#{{ $profile->id }} {{ $profile->name }}</h4>
                        <p class="card-text">Email: <a href="mailto:{{ $profile->email }}" class="text-primary">{{ $profile->email }}</a></p>
                        <p class="card-text">{{ $profile->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="my-4">Commentaire</h3>
                <div class="row">
                    @foreach($profile->publications as $publication)
                        <x-publication :publication="$publication"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-master>
