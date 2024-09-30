@extends('layouts.app')

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">Portfolio Progetti</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas deserunt minus hic beatae sequi natus voluptatem a ratione minima possimus, quaerat ut vitae laboriosam quasi voluptatum atque dignissimos fugiat velit animi ducimus! Eius provident voluptatibus voluptates dolore quos perferendis rerum nobis, aliquam est amet excepturi. Laudantium, molestias quibusdam! Neque reiciendis facere ipsum praesentium dignissimos sapiente cum illo blanditiis fuga. Pariatur nesciunt doloremque sapiente? Similique id harum consectetur autem sunt eius magnam dolores tempore obcaecati vitae architecto, veniam numquam assumenda nesciunt cumque voluptates ipsum, laborum non atque deserunt quidem officia voluptas ab! Molestiae autem dolorem officiis ipsa neque possimus tempore corrupti.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href=" {{ route('admin.projects.index') }} " class="btn btn-primary btn-lg px-4 gap-3">Tutti i Progetti</a>
            <a href=" {{ route('home') }} " class="btn btn-outline-secondary btn-lg px-4">Pagina Pubblica</a>
        </div>
    </div>
</div>
@endsection

@section('title')
    Dashboard
@endsection
