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

        <h1>Technologies</h1>

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-6">
                    <form action="{{route('admin.technologies.store')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Aggiungi Tecnologia">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Salva</button>
                        </div>
                    </form>
                    <table class="table">
                        <tbody>
                            @foreach ($technologies as $technology)
                                <tr>
                                    <td>
                                        <form id="form-edit-{{$technology->id}}" action="{{route('admin.technologies.update', $technology)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input class="my_input" type="text" name="name" value="{{ $technology->name }}">
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" type="submit" onclick="submitEditTechnologyForm({{$technology->id}})">Salva</button>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Elimina
                                            </button>
                                        </form>
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
        function submitEditTechnologyForm(id){
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>
@endsection

@section('title')
    Technologies
@endsection
