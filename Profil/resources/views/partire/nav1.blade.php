<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('homepage')}}">Your Website</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('homepage')}}">Accueil</a>
        </li>
        
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{route('login.show')}}">Se Conncter</a>
        </li>
        @endguest
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('profiles.index')}}">Tous Post</a>
        </li>
        <li class="nav-item">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('information.index')}}">Mes Informations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('profiles.create')}}">Ajouter Post</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('publications.index')}}">Commentaire</a>
        </li>
        @auth
        <li class="nav-item">
            <a class="nav-link" href="{{route('publications.create')}}">Ajouter Commentaire</a>
        </li>
    </ul>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{auth()->user()->name}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{route('login.logout')}}">Deconnexion</a>
        </div>
    </div>
    @endauth
</nav>
