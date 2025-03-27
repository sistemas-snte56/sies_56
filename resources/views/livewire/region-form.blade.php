<div>
    <center>
        <h1>{{$mensaje}}</h1>
        <button class="btn btn-input btn-primary" wire:click="CambiarMensaje" >Mensaje </button>
    </center>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Region</th>
                <th scope="col">Sede</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regiones as $region)
                <tr>
                    <th scope="row">{{$region->id}}</th>
                    <td>{{$region->region}}</td>
                    <td>{{$region->sede}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>