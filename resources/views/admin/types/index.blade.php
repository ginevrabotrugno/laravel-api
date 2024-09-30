@extends('layouts.app')

@section('content')
    <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-danger" role="alert">
                {{ session('deleted') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <h1>Types</h1>

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-6">
                    <form action="{{route('admin.types.store')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Aggiungi Tipo">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Salva</button>
                        </div>
                    </form>
                    <table class="table">
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>
                                        <form id="form-edit-{{$type->id}}" action="{{route('admin.types.update', $type)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input class="my_input" type="text" name="name" value="{{ $type->name }}">
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" type="submit" onclick="submitEditTypeForm({{$type->id}})">Salva</button>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.types.destroy', $type)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.projectsPerType', $type)}}" class="btn btn-success">
                                            Tutti i Progetti
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <script>
        function submitEditTypeForm(id){
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>
@endsection

@section('title')
    Types
@endsection
