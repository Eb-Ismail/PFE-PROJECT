<x-master title="Mon Profile"><h3>Ajouter Commentaire </h3>
    @foreach ($errors->all() as $error)
        <x-alert type="danger">
            {{$error}}
        </x-alert>
    @endforeach
    <form action="{{route('publications.store')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{old('titre')}}">
            @error('titre')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="body">{{old('body')}}</textarea>
        @error('body')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="d-grid my-2">
            <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
        </div>
    </form>
</x-master>