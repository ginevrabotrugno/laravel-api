@extends('layouts.app')

@section('content')

    <div class="container my-4">
        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="my-5">
            I MIEI PROGETTI
            <a href="{{route('admin.projects.create')}}" class="btn btn-light">
                <i class="fa-solid fa-plus"></i>
            </a>
        </h1>

        <form action="{{ route('admin.projects.index') }}" method="GET" class="d-flex justify-content-between align-items-center mb-4">
            <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        @if ($projects->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <span class="d-block">La Ricerca non ha prodotto risultati</span>
                <a href=" {{ route('admin.projects.index') }} " class="text-center btn btn-outline-warning m-3">Tutti i Progetti</a>
            </div>
        @else

            <form id="delete-multiple-form" action="{{ route('admin.deleteMultiple') }}" method="POST"  onsubmit="return confirm('Sei sicuro di voler eliminare i progetti selezionati?')">
                @csrf
                @method('DELETE')

                <input type="hidden" name="selected_projects" id="projects-input">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-danger mb-3" id="delete-selected-btn" disabled>Elimina Selezionati</button>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>#id</th>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>Status</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Technologies</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td><input type="checkbox" name="projects[]" value="{{ $project->id }}" class="project-checkbox"></td>
                                <th> {{ $project->id }} </th>
                                <td> {{ $project->title }} </td>
                                <td> {{ ($project->start_date)->format('d/m/Y') }} </td>
                                <td> {{ $project->status }} </td>
                                <td class="text-center">
                                    @if ($project->type)
                                        <a href="{{route('admin.projectsPerType', $project->type)}}" class="btn btn-light">
                                            {{ $project->type->name }}
                                        </a>
                                    @else
                                        ---
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($project->technologies)
                                        @forelse($project->technologies as $technology)
                                            <span class="badge text-bg-info">{{$technology->name}}</span>
                                        @empty
                                            ---
                                        @endforelse
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.projects.show', $project)}}" class="btn btn-success">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('form-delete-{{$project->id}}').submit();">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>

            @foreach ($projects as $project)
                <form id="form-delete-{{$project->id}}" action="{{route('admin.projects.destroy', $project)}}" method="POST" class="d-none" onsubmit="return confirm('Sei sicuro di voler eliminare {{$project->title}}?')">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

            {{-- <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash-can"></i>
            </button> --}}


            {{$projects->appends(['search' => request()->input('search')])->links()}}

        @endif
    </div>

    <script>
        // Passo gli ID dei progetti dal backend al frontend
        const allProjectIds = @json($allProjs->pluck('id')); //Devo convertire l'array php in Json così che possa essere utilizzato da Javascript

        let selectedProjectIds = JSON.parse(localStorage.getItem('selectedProjectIds')) || []; //Devo parsare l'array JS in json per salvarlo in localstorage, se non lo trova restituisce un array vuoto

        // Aggiorna lo stato delle checkbox al caricamento della pagina, e quindi anche al cambio pagina dell'elenco projects
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.project-checkbox'); //tutte le checkbox
            const selectAllCheckbox = document.getElementById('select-all'); //checkbox select-all

            checkboxes.forEach(checkbox => {
                if (selectedProjectIds.includes(parseInt(checkbox.value))) {
                    checkbox.checked = true;
                }
            });

            //sempre al caricamento della pagina aggiorna lo stato di select-all
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked;

            // Abilita/disabilita il pulsante di eliminazione
            document.getElementById('delete-selected-btn').disabled = selectedProjectIds.length === 0;
        });

        // Gestisci la selezione delle checkbox
        document.querySelectorAll('.project-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const projectId = parseInt(this.value);
                if (this.checked) {
                    selectedProjectIds.push(projectId);
                } else {
                    selectedProjectIds = selectedProjectIds.filter(id => id !== projectId);
                }
                localStorage.setItem('selectedProjectIds', JSON.stringify(selectedProjectIds));

                // Abilita/disabilita il pulsante di eliminazione
                document.getElementById('delete-selected-btn').disabled = selectedProjectIds.length === 0;
            });
        });

        // Seleziona/deseleziona tutte le checkbox
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.project-checkbox');

            if (this.checked) {
                // Seleziona tutte le checkbox
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    const projectId = parseInt(checkbox.value);
                    if (!selectedProjectIds.includes(projectId)) {
                        selectedProjectIds.push(projectId);
                    }
                });

                // Aggiungi anche gli ID dei progetti non visibili
                allProjectIds.forEach(id => {
                    if (!selectedProjectIds.includes(id)) {
                        selectedProjectIds.push(id);
                    }
                });

            } else {
                // Deseleziona tutte le checkbox
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                selectedProjectIds = []; // Svuota l'array di selezione
            }

            // Aggiorna il pulsante di eliminazione
            document.getElementById('delete-selected-btn').disabled = selectedProjectIds.length === 0;

            // Aggiorna localStorage
            localStorage.setItem('selectedProjectIds', JSON.stringify(selectedProjectIds));
        });

        // Funzione per gestire l'invio del modulo
        document.getElementById('delete-multiple-form').addEventListener('submit', function(event) {
            // Imposta il valore dell'input hidden con l'array degli ID selezionati
            const projectsInput = document.getElementById('projects-input');
            projectsInput.value = JSON.stringify(selectedProjectIds); // Converti l'array in JSON

            // Svuota localStorage dopo aver salvato gli ID
            localStorage.removeItem('selectedProjectIds');
        });
    </script>

@endsection

@section('title')
    Projects
@endsection

