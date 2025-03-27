<div class="card">
    <div class="card-header">
        <x-adminlte-button wire:click="clear" label="Región" data-toggle="modal" data-target="#modalRegion"
            class="bg-primary" />
    </div>

    <div class="card-body">

        <div class="card-title">

            <form wire:submit.prevent="{{ $regionId ? 'update' : 'submit' }}">
                <x-adminlte-modal id="modalRegion" title="{!! $regionId ? 'Editar Región' : 'Nueva Región' !!}" size="lg" theme="primary"
                    icon="{!! $regionId ? 'fas fa-pen' : 'fas fa-plus' !!}" wire:ignore.self>
                    <x-adminlte-input wire:model="region" name="region" label="Nombre de región"
                        placeholder="Igresa el nombre" fgroup-class="col-md-12" />
                    <x-adminlte-input wire:model="sede" name="sede" label="Nombre de la sede"
                        placeholder="Igresa la sede" fgroup-class="col-md-12" />

                    <div wire:loading class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Cargando...
                    </div>

                    <x-slot name="footerSlot">
                        <x-adminlte-button type="submit" wire:loading.attr="disabled" theme="success"
                            label="{!! $regionId ? 'Actualizar' : 'Guardar' !!}" />
                        <x-adminlte-button wire:click.prevent="clear" theme="secondary" label="Cancelar" class="mr-auto"
                            data-dismiss="modal" />
                    </x-slot>


                </x-adminlte-modal>
            </form>


        </div>


        @php
            $heads = ['ID', 'REGIÓN', 'SEDE', ['label' => 'Actions', 'no-export' => true, 'width' => 10]];

            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </button>';

            $config = [
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, ['orderable' => false]],
                'language' => ['url' => 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json'],
                'lengthMenu' => [14, 20],
                'searching' => true,
                'paging' => true,
                'info' => true,
                'responsive' => true,
            ];
        @endphp


        <div class="row my-4">
            <div class="col-md-8">
                <div class="dt-buttons btn-group flex-wrap">
                    <div class="btn-group"><button
                            class="btn buttons-collection dropdown-toggle buttons-page-length btn-default"
                            tabindex="0" aria-controls="table1" type="button" aria-haspopup="dialog"><span>Mostrar 14
                                filas</span><span class="dt-down-arrow"></span></button></div> <button
                        class="btn buttons-print btn-default" tabindex="0" aria-controls="table1" type="button"
                        title="Print"><span><i class="fas fa-fw fa-lg fa-print"></i></span></button> <button
                        class="btn buttons-csv buttons-html5 btn-default" tabindex="0" aria-controls="table1"
                        type="button" title="Export to CSV"><span><i
                                class="fas fa-fw fa-lg fa-file-csv text-primary"></i></span></button> <button
                        class="btn buttons-excel buttons-html5 btn-default" tabindex="0" aria-controls="table1"
                        type="button" title="Export to Excel"><span><i
                                class="fas fa-fw fa-lg fa-file-excel text-success"></i></span></button> <button
                        class="btn buttons-pdf buttons-html5 btn-default" tabindex="0" aria-controls="table1"
                        type="button" title="Export to PDF"><span><i
                                class="fas fa-fw fa-lg fa-file-pdf text-danger"></i></span></button>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <div id="table1_filter" class="dataTables_filter">
                    <label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="search" name="search" wire:model="search"
                                wire:keyup="set('search', $event.target.value)" class="form-control form-control-sm"
                                placeholder="Buscar:">
                        </div>
                    </label>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-striped table-hover table-bordered">

                    <thead class="bg-orange">
                        <tr>
                            <th scope="col" style="color: white;">#</th>
                            <th scope="col" style="color: white;">REGION</th>
                            <th scope="col" style="color: white;">SEDE</th>
                            <th scope="col" style="width: 100px;color: white;">CONFIGURACION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($regiones->count() > 0)
                            @foreach ($regiones as $region)
                                <tr>
                                    <td>{{ $region->id }}</td>
                                    <td>{{ $region->region }}</td>
                                    <td>{{ $region->sede }}</td>
                                    <td>
                                        <button wire:click="edit({{ $region->id }})" data-toggle="modal"
                                            data-target="#modalRegion"
                                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </button>

                                        <button wire:click="regionDelete({{ $region->id }})"
                                            class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No hay registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">
                    {{ $regiones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        // Escuchar el evento emitido por Livewire para cerrar el modal
        Livewire.on('closeModal', () => {
            $('#modalRegion').modal('hide'); // Cierra el modal con el ID "modalRegion"
        });

        Livewire.on("confirm", (event) => {
            Swal.fire({
                title: "¿Estas seguro...?",
                text: "No se podra revertir esto",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, Borrarlo",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete', {id:event.id});
                    // alert(event.id);
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "La Región ha sido eliminada.",
                        icon: "success"
                    });
                }
            });            
        });
    </script>
@endpush
