<x-master title="Mon Profile"><h3>Ajouter Post</h3>
    @foreach ($errors->all() as $error)
        <x-alert type="danger">
            {{$error}}
        </x-alert>
    @endforeach
    <form action="{{route('profiles.store')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nom Complet</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="{{old('email')}}">
            @error('email')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Pasword</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Validation de Pasword</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{old('password')}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="bio">{{old('bio')}}</textarea>
            @error('bio')
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