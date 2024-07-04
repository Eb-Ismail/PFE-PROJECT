<x-master title="Mon Profile"><h3>Modifier Post</h3>
    @foreach ($errors->all() as $error)
        <x-alert type="danger">
            {{$error}}
        </x-alert>
    @endforeach
    <form action="{{route('profiles.update',$profile->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Nom Complet</label>
            <input type="text" name="name" class="form-control" value="{{old('name',$profile->name)}}">
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="{{old('email',$profile->email)}}">
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
            <input type="password" name="password_confirmation" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="bio">{{old('bio',$profile->bio)}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="d-grid my-2">
            <button type="submit" class="btn btn-primary btn-block">Modifier</button>
        </div>
    </form>
</x-master>