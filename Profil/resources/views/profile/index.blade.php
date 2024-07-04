<x-master title="Profiles">
    <div class="row my-5">
    @foreach($profiles as $profile)
        <x-profile-card :profile="$profile"/>
    @endforeach
    </div>
    {{$profiles->links()}}
</x-master>

