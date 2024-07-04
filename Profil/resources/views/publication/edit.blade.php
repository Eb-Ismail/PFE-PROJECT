<x-master title="Mon Profile"><h3>Modifier Commentaire </h3>
    @foreach ($errors->all() as $error)
        <x-alert type="danger">
            {{$error}}
        </x-alert>
    @endforeach
    <form action="{{route('publications.update',$publication->id)}}" method="POST"  enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{old('titre',$publication->titre)}}">
            @error('titre')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="body">{{old('body',$publication->body)}}</textarea>
        @error('body')
            <div class="text-danger">{{$message}}</div>
        @enderror
        </div> 
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        @error('image')
            <div class="text-danger">{{$message}}</div>
        @enderror
        <div>
            <img src="{{asset('storage/'.$publication->image)}}" width="200" alt="">
        </div>
        </div>
        <div class="d-grid my-2">
            <button type="submit" class="btn btn-success btn-block">Update</button>
        </div>
    </form>
</x-master>