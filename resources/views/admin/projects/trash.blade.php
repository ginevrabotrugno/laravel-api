@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <h1 class="my-5">Cestino</h1>

        <ul class="list-group m-4">

            @foreach ($projects as $project)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><strong>Id: </strong> {{ $project->id }} || <strong>Titolo:</strong>  {{ $project->title }} </span>
                    <a href="{{route('admin.projects.show', $project)}}" class="btn btn-success">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('title')
    Trash
@endsection
