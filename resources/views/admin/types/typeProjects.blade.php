@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1 class="my-5">Elenco Progetti per Tipo</h1>

        @foreach ($types as $type)
            <h3> {{ $type->name }} <span class="badge bg-info"> {{ $type->projects->count() }} </span> </h3>

            <ul class="list-group m-4">

                @foreach ($type->projects as $project)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span> {{ $project->title }} </span>
                        <a href="{{route('admin.projects.show', $project)}}" class="btn btn-success">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </li>
                @endforeach
           </ul>
        @endforeach
    </div>
@endsection

@section('title')
    Type Projects
@endsection
