<x-master title="Page publication"><h3>Commentaire </h3>
<div class="container w-75 mx-auto">
    <div class="row">
        @foreach($publications as $publication)
            <x-publication  :publication="$publication"/>
        @endforeach
    </div>
</div>
{{$publications->links()}}
</x-master >