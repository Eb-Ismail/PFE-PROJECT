<x-master title="Page d'form">
    <h3>Request/Response</h3>
    <form method="POST" action="{{route('form')}}">
        @csrf
        <input type="date" name="input_field" class="form-contro">
        <input type="submit" value="Envoyer" class="btn btn-sm btn-primary my-3"> 
    </form>
</x-master>