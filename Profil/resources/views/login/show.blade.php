<x-master title="Se connecter">
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card bg-light border-dark">
                  <div class="card-header bg-dark text-white">
                      Login
                  </div>
                  <div class="card-body">
                      <form action="{{route('login')}}" method="POST">
                          @csrf
                          <div class="form-group">
                              <label for="username" class="text-dark">Email:</label>
                              <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}">
                              @error('username')
                                  <div class="text-danger">{{$message}}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="password" class="text-dark">Mot de passe:</label>
                              <input type="password" class="form-control" id="password" name="password">
                          </div>
                          <button type="submit" class="btn btn-primary my-2">Login</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-master>
